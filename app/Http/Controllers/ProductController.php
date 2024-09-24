<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
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
            $p['avg_price'] = number_format(floor($p->productVariant->avg('price')),0,'.',',');
            $stockPerColor = $p->productVariant->pluck('stock_per_color')->all();
            $p['total_stock'] = 0;
            foreach($stockPerColor as $variant) {
                $variant = explode(";", $variant);
                foreach($variant as $v) {
                    $p['total_stock'] += (int)explode("/", $v)[0];
                }
            }
            // $stockPerColor = explode(";", $p['stock_per_color']);
            // $p['total_stock'] = explode("/", $p->productVariant->pluck('stock_per_color')->first())[0];
            // foreach($stockPerColor as $colorVariant) {
            //     $p['total_stock'] += explode("/", (int)$colorVariant)[0];
            // }
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
        Validator::make($request->all(), [
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
            'status' => 'draft',
        ]);

        return redirect()->route('admin.product-edit', $product->id);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $productVariant = $product->productVariant;
        $category = Category::all();

        foreach($productVariant as $variant) {
            $variant['size'] = explode(".", $variant['size_in_cm'])[0];
            $variant['h'] = explode("-", explode(".", $variant['size_in_cm'])[1])[0];
            $variant['w'] = explode("-", explode(".", $variant['size_in_cm'])[1])[1];
            $variant['t'] = explode("-", explode(".", $variant['size_in_cm'])[1])[2];
            $stockPerColor = explode(";", $variant['stock_per_color']);
            $variant['total_stock'] = 0;
            foreach($stockPerColor as $colorVariant) {
                $variant['total_stock'] += (int)explode("/", $colorVariant)[0];
            }
        }

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
