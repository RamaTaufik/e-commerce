<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductPicture;
use App\Models\Address;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout(Request $request)
    {
        $cart = [];
        $total = 0;
        foreach($request->cart_item as $cartItem) {
            $data = ProductVariant::where('product_variant_code', session('cart')[$cartItem])->first();
            $cart[$cartItem] = [
                'name' => $data->product->name,
                'image' => ProductPicture::where('product_variant_code', $cartItem['product_variant_code'])->first()->directory,
                'price' => $data->price,
                'size' => explode($data->size_in_cm, '.')[0],
                'color' => $explode($cartItem,'.')[1],
            ];
            $total += $cartItem['qty']*$cart[$cartItem['product_variant_code']]['price'];
        }
        $address['provinsi'] = Address::groupBy('provinsi')->pluck('provinsi');
        foreach($address['provinsi'] as $province) {
            $address['kabupaten'][$province] = Address::where('provinsi', $province)->groupBy('kabupaten')->pluck('kabupaten');
            foreach($address['kabupaten'][$province] as $city) {
                $address['kecamatan'][$city] = Address::where('kabupaten', $city)->groupBy('kecamatan')->pluck('kecamatan');
            }
        }

        return view('order', compact(['cart','address','total']));
    }
}
