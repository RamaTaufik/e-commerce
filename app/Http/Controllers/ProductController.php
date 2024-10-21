<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use App\Models\ProductPicture;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $product = Product::all()->where('status','public');
        foreach($product as $p) {
            $p['category'] = $p->category()->pluck('name')->first();
            $p['total_stock'] = $p->productVariant->pluck('stock')->sum();
        }

        $category = Category::all();

        return view('admin.product', compact(['product','category']));
    }

    protected function archive()
    {
        $product = Product::all()->where('status','draft');
        foreach($product as $p) {
            $p['category'] = $p->category()->pluck('name')->first();
            $p['total_variant'] = count($p->productVariant);
        }

        return view('admin.product-archive', compact('product'));
    }

    protected function publishing($id)
    {
        $product = Product::find($id);
        $product->status = 'public';
        $product->save();

        return redirect()->route('admin.product-archive');
    }

    protected function archiving($id)
    {
        $product = Product::find($id);
        $product->status = 'draft';
        $product->save();

        return redirect()->route('admin.product');
    }


    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'category_code' => ['required'],
            'description' => ['required'],
        ], [
            'name' => 'Nama produk tidak sesuai',
            'category_code' => 'Harus diisi',
            'description' => 'Harus diisi',
        ]);
        $product = Product::create([
            'name' => $request['name'],
            'category_code' => $request['category_code'],
            'description' => $request['description'],
            'material' => $request['material'],
            'status' => 'draft',
        ]);
        
        $request['product_id'] = $product->id;
        $request['variation'] = 'Base';

        $serial = count(ProductVariant::where('product_id',$request->product_id)->get()) + 1;
        ProductVariant::create([
            'product_variant_code' => $request->product_id.'-'.$serial,
            'product_id' => $request->product_id,
            'variation' => $request->variation,
            'size_in_cm' => $request['h'].'-'.$request['w'].'-'.$request['t'],
            'weight_in_gram' => $request['weight_in_gram'],
            'price' => $request['price'],
            'stock' => $request->stock,
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

        return redirect()->route('admin.product-edit', $product->id);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $productVariant = $product->productVariant;
        $category = Category::all();
        
        $product['total_stock'] = $productVariant->pluck('stock')->sum();

        return view('admin.product-edit', compact(['product','productVariant','category']));
    }

    public function update(Request $request, $id)
    {
        Product::find($id)->update($request->all());

        return redirect()->route('admin.product-edit', $id);
    }

    public function destroy($id)
    {
        $imgDirectory = ProductVariant::where('product_id', '$id')->pluck('product_variant_code')->get();
        foreach($imgDirectory as $dir) {
            File::deleteDirectory(public_path('image/products/'.$dir));
        }
        Product::find($id)->delete();

        return redirect()->back();
    }
}
