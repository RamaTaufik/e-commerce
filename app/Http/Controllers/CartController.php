<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\ProductVariant;
use App\Models\ProductPicture;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Shipment;
use Auth;

class CartController extends Controller
{
    public function index($cost = '', $prevRequest = '')
    {
        $cart = [];
        $customer_id = Customer::where('user_id', Auth::id())->pluck('id')->first();
        $myAddresses = CustomerAddress::where('customer_id', $customer_id)->get();
        if(session()->has('cart')) {
            foreach (session('cart') as $cart_item) {
                $data = ProductVariant::where('product_variant_code', $cart_item['product_variant_code'])->first();
                $cart[$cart_item['product_variant_code'].'.'.$cart_item['color']] = [
                    'name' => $data->product->name,
                    'image' => ProductPicture::where('product_variant_code', $cart_item['product_variant_code'])->first()->directory,
                    'price' => $data->price,
                    'size' => strtoupper(explode('.', $data->size_in_cm)[0]),
                    'color' => $cart_item['color'],
                ];
            }
        }
        $address['provinsi'] = Province::all();
        foreach($address['provinsi'] as $province) {
            $address['kota'][$province->name] = $province->city->all();
        }
        $shipments = Shipment::all();

        if($cost == '') {
            return view('cart', compact(['cart','myAddresses','address','shipments']));
        } else {
            dd($cost);
            return view('cart', compact(['cart','myAddresses','address','shipments','cost','prevRequest']));
        }
    }

    public function add(Request $request)
    {
        $data = session()->get('cart', []);
        $data[$request->code.'.'.$request->color] = [
            'product_variant_code' => $request->code,
            'color' => $request->color,
            'qty' => $request->qty,
        ];
        session()->put('cart', $data);

        return redirect()->back()->with('Berhasil ditambahkan di keranjang');
    }

    public function buy(Request $request)
    {
        $data = session()->get('cart', []);
        $data[$request->code.'.'.$request->color] = [
            'product_variant_code' => $request->code,
            'color' => $request->color,
            'qty' => $request->qty,
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
