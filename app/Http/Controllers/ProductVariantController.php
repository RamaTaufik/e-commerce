<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Validator;

class ProductVariantController extends Controller
{
    public function create(Request $request)
    {
        // Validator::make($request->all(), [
        //     'name' => ['required', 'string'],
        //     'category_code' => ['required'],
        // ], [
        //     'name' => 'Nama produk tidak sesuai',
        //     'category_code' => 'Harus diisi',
        // ]);
        $serial = count(ProductVariant::where('product_id',$request->product_id)->get())+1;
        $variant = ProductVariant::create([
            'product_variant_code' => $request->product_id.'-'.$serial,
            'product_id' => $request->product_id,
            'size(cm)' => $request['size(cm)'].'.'.$request->h.'-'.$request->w.'-'.$request->t,
            'weight(g)' => $request['weight(g)'],
            'material' => $request->material,
            'price' => $request->price,
            'stock' => $request->stock,
            'color' => $request->color,
        ]);

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
