<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductPicture;

class CartController extends Controller
{
    public function index()
    {
        $cart = [];
        if(session()->has('cart')) {
            foreach (session('cart') as $cart_item) {
                $data = ProductVariant::where('product_variant_code', $cart_item['product_variant_code'])->first();
                $cart[$cart_item['product_variant_code']] = [
                    'name' => $data->product->name,
                    'image' => ProductPicture::where('product_variant_code', $cart_item['product_variant_code'])->first()->directory,
                    'price' => $data->price,
                ];
            }
        }

        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $data = session()->get('cart', []);
        $data[$request->code] = [
            'product_variant_code' => $request->code,
            'qty' => $request->qty,
            'color' => $request->color,
        ];
        session()->put('cart', $data);

        return redirect()->route('cart');
    }

    public function remove(Request $request)
    {
        $cart = [];
        foreach(session('cart') as $cartItem) {
            foreach($request->all() as $item) {
                if(!ProductVariant::where('product_variant_code',$item)->exists()) {
                    continue;
                }
                if($cartItem['product_variant_code']!=$item) {
                    $cart[$item] = $cartItem[$item];
                }
            }
        }
        if($cart == []) {
            session()->flush();
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }
}
