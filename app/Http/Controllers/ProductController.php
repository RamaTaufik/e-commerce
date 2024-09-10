<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

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
            $p['avg_price'] = 'Rp'.number_format(floor($p->productVariant->avg('price')),0,'.',',');
            $p['total_stock'] = $p->productVariant->sum('stock');
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

    public function create(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'category_code' => ['required'],
        ], [
            'name' => 'Nama produk tidak sesuai',
            'category_code' => 'Harus diisi',
        ]);
        $product = Product::create([
            'name' => $request['name'],
            'category_code' => $request['category_code'],
            'status' => 'draft'
        ]);

        return redirect()->route('admin.product-edit', $product->id);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();

        return view('admin.product-edit', compact(['product','category']));
    }
}
