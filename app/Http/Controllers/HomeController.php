<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductPicture;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

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

        return view('home', compact('product'));
    }

    public function product($id)
    {
        $product = Product::find($id);
        $productVariant = ProductVariant::where('product_id', $id)->get();
        return view('product', compact(['product','productVariant']));
    }
}
