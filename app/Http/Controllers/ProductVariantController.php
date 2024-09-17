<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductPicture;
use Illuminate\Support\Facades\Validator;

class ProductVariantController extends Controller
{
    public function create(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'category_code' => ['required'],
            'image' => ['required', 'max:5']
        ], [
            'name' => 'Nama produk tidak sesuai',
            'category_code' => 'Harus diisi',
            'image.required' => 'Harus memilih minimal 1 gambar',
            'image.max' => 'Maksimum 5 gambar',
        ]);
        $serial = count(ProductVariant::where('product_id',$request->product_id)->get())+1;
        $color = isset($request->color)?$request->color:"NULL";
        ProductVariant::create([
            'product_variant_code' => $request->product_id.'-'.$serial,
            'product_id' => $request->product_id,
            'size_in_cm' => $request->size_in_cm.'.'.$request->h.'-'.$request->w.'-'.$request->t,
            'weight_in_gram' => $request->weight_in_gram,
            'material' => $request->material,
            'price' => $request->price,
            'stock_per_color' => $request->stock.'/'.$color,
        ]);

        if($request->hasFile('image')) {
            $dir = 'image/products/'.$request->product_id.'-'.$serial.'/';
            if(!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            } 
            $image = $request->file('image');
            foreach($image as $img) {
                $fileName = (count(scandir(public_path($dir)))-1).'.'.$img->getClientOriginalExtension();
                $img->move(public_path($dir), $fileName);
                ProductPicture::create([
                    'product_variant_code' => $request->product_id.'-'.$serial,
                    'directory' => $request->product_id.'-'.$serial.'/'.$fileName,
                ]);
            }
        }

        return redirect()->route('admin.product-edit', $request->product_id.'-'.$serial);
    }

    public function update(Request $request, $id)
    {
        $variant = ProductVariant::find($id)->update($request->all());

        return redirect()->route('admin.product-edit', $variant->product_id);
    }

    public function destroy($id)
    {
        ProductVariant::find($id)->delete();

        return redirect()->back();
    }
}
