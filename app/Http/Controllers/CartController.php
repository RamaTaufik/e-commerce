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
    public function index()
    {
        $cart = [];
        $customer_id = Customer::where('user_id', Auth::id())->pluck('id')->first();
        $myAddresses = CustomerAddress::where('customer_id', $customer_id)->get();
        if(session()->has('cart')) {
            foreach (session('cart') as $cart_item) {
                $data = ProductVariant::where('product_variant_code', $cart_item['code'])->first();
                $cart[$cart_item['code']] = [
                    'name' => $data->product->name,
                    'image' => ProductPicture::where('product_variant_code', $cart_item['code'])->first()->directory,
                    'price' => $data->product->price,
                    'variation' => $data->variation,
                ];
            }
        }
        $address['provinsi'] = Province::all();
        foreach($address['provinsi'] as $province) {
            $address['kota'][$province->name] = $province->city->all();
        }
        $shipments = Shipment::all();

        return view('cart', compact(['cart','myAddresses','address','shipments']));
    }

    public function add(Request $request, $buy = false)
    {
        $data = session()->get('cart', []);
        $data[$request->code] = [
            'code' => $request->code,
            'qty' => $request->qty,
        ];
        session()->put('cart', $data);

        if($buy) {
            return redirect()->route('cart');
        } else {
            return redirect()->back()->with('Berhasil ditambahkan ke keranjang');
        }
    }

    public function update()
    {
        $qtyChange = $_POST['qtyChange'];
        $data = session()->get('cart', []);
        foreach($qtyChange as $item) {
            $data[$item[0]] = [
                'code' => $item[0],
                'qty' => $item[1],
            ];
        }
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
                if($cartItem['code']!=$item) {
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
