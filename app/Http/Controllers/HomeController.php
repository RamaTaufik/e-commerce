<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductPicture;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::where('status', 'public')->get();

        foreach($product as $item) {
            $item['display_image'] = ProductPicture::where('product_variant_code', $item->id.'-1')->pluck('directory')->first();
        }

        $category = Category::all();

        return view('home', compact(['product','category']));
    }

    public function search(Request $request)
    {
        $index = $request['index'];
        $product = Product::where('status', 'public')
                          ->where('name', 'LIKE', '%'.$index.'%')->get();

        foreach($product as $item) {
            $item['display_image'] = ProductPicture::where('product_variant_code', $item->id.'-1')->pluck('directory')->first();
        }

        return view('search', compact(['product','index']));
    }

    public function product($id)
    {
        $product = Product::find($id);
        $productVariant = ProductVariant::where('product_id', $id)->get();
        return view('product', compact(['product','productVariant']));
    }
}
