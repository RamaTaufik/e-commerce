<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
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
        $customer_id = '';
        $myAddresses = [];
        if(Auth::check()) {
            $customer_id = Customer::where('user_id', Auth::id())->first()->id;
            $myAddresses = CustomerAddress::where('customer_id', $customer_id)->get();
            // foreach($myAddresses as $myAddress) {
            //     $myAddress['address'] = $myAddress->address->id;
            //     $province = Province::where('name', $myAddress['address']->provinsi);
            //     $myAddress['city'] = City::where('name', $myAddress['address']->kabupaten)
            //                              ->where('province_id', $province->id)->first();
            // }
        }
        if(session()->has('cart')) {
            foreach (session('cart') as $cart_item) {
                $data = ProductVariant::where('product_variant_code', $cart_item['code'])->first();
                $cart[$cart_item['code']] = [
                    'name' => $data->product->name,
                    'image' => ProductPicture::where('product_variant_code', $cart_item['code'])->first()->directory,
                    'qty' => $cart_item['qty'],
                    'price' => $data->price,
                    'variation' => $data->variation,
                ];
            }
        }
        $addresses = City::orderBy('province_id')->get();
        $shipments = Shipment::all();

        return view('cart', compact(['cart','myAddresses','addresses','shipments']));
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
    }

    public function remove(Request $request)
    {
        $cart = [];
        foreach(session('cart') as $cartItem) {
            foreach($request->cart_item as $item) {
                if($cartItem['code']!=$item) {
                    $cart[$cartItem['code']] = $cartItem;
                    continue(2);
                }
            }
        }
        session()->put('cart', $cart);

        return redirect()->route('cart');
    }
}
