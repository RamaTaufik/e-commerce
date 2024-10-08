<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductPicture;

class ProductVariantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string'],
        //     'category_code' => ['required'],
        //     'image' => ['required', 'max:5']
        // ], [
        //     'name' => 'Nama produk tidak sesuai',
        //     'category_code' => 'Harus diisi',
        //     'image.required' => 'Harus memilih minimal 1 gambar',
        //     'image.max' => 'Maksimum 5 gambar',
        // ]);
        $serial = count(ProductVariant::where('product_id',$request->product_id)->get()) + 1;
        $variant = ProductVariant::create([
            'product_variant_code' => $request->product_id.'-'.$serial,
            'product_id' => $request->product_id,
            'variant' => $request->price,
            'stock' => $request->stock.'/'.$color,
        ]);

        if($request->hasFile('image')) {
            $dir = 'image/products/'.$variant->product_variant_code.'/';
            if(!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            } 
            $image = $request->file('image');
            foreach($image as $img) {
                $fileName = (count(scandir(public_path($dir)))-1).'.'.$img->getClientOriginalExtension();
                $img->move(public_path($dir), $fileName);
                ProductPicture::create([
                    'product_variant_code' => $variant->product_variant_code,
                    'directory' => $variant->product_variant_code.'/'.$fileName,
                ]);
            }
        }

        return redirect()->route('admin.product-edit', $variant->product_id);
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
