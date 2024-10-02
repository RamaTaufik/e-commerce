<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Models\ProductVariant;
use App\Models\ProductPicture;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Shipment;
use App\Models\CustomerAddress;
use App\Models\Order;
use Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function checkout(Request $request)
    // {
    //     $cart = [];
    //     $total['price'] = 0;
    //     $total['weight'] = 0;
    //     foreach($request->cart_item as $cartItem) {
    //         $data = ProductVariant::where('product_variant_code', session('cart')[$cartItem])->first();
    //         $cart[$cartItem] = [
    //             'name' => $data->product->name,
    //             'image' => ProductPicture::where('product_variant_code', $cartItem)->pluck('directory')->first(),
    //             'price' => $data->price,
    //             'qty' => session('cart')[$cartItem]['qty'],
    //             'size' => strtoupper(explode('.', $data->size_in_cm)[0]),
    //             'color' => explode('.', $cartItem)[1],
    //         ];
    //         $total['price'] += session('cart')[$cartItem]['qty']*$cart[$cartItem]['price'];
    //         $total['weight'] += session('cart')[$cartItem]['qty']*ProductVariant::where('product_variant_code', explode('.',$cartItem))->pluck('weight_in_gram')->first();
    //     }
    //     $address['provinsi'] = Province::all();
    //     foreach($address['provinsi'] as $province) {
    //         $address['kota'][$province->name] = $province->city->all();
    //     }

    //     return view('order', compact(['cart','myAddresses','address','total','shipments']));
    // }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request)
    {
        $cart = [];
        $total = [];
        $total['price'] = 0;
        $total['weight'] = 0;
        
        foreach($request->cart_item as $cartItem) {
            $variant = ProductVariant::where('product_variant_code', explode('.',$cartItem)[0])->first();
            $cart[$cartItem] = [
                'name' => $variant->product->name,
                'image' => ProductPicture::where('product_variant_code', $cartItem)->pluck('directory')->first(),
                'price' => $variant->price,
                'qty' => session('cart')[$cartItem]['qty'],
                'size' => strtoupper(explode('.', $variant->size_in_cm)[0]),
                'color' => explode('.', $cartItem)[1],
            ];
            $total['price'] += session('cart')[$cartItem]['qty']*$variant->pluck('price')->first();
            $total['weight'] += session('cart')[$cartItem]['qty']*$variant->pluck('weight_in_gram')->first();
        }

        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 22, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $total['weight'], // berat barang dalam gram
            'courier'       => Shipment::find($request->shipment_id)->pluck('shipment_name')->first(), // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return view('order', compact(['cart','total','cost']));
    }

    public function buy(Request $request)
    {
        $request->validate([
            'myAddress' => ['required'],
            'provinsi' => ['required','exists:addresses,provinsi'],
            'kabupaten' => ['required','exists:addresses,kabupaten'],
            'kelurahan' => ['required','exists:addresses,kelurahan'],
            'address_detail' => ['required'],
            'shipment_id' => ['required','exist:shipment'],
        ],[
            'required' => 'Harus diisi',
            'exists' => 'Tidak ada dalam pilihan',
        ]);

        $address = Address::where('provinsi',$request->provinsi)->andwhere('kabupaten',$request->kabupaten)->andwhere('kelurahan',$request->kelurahan);
        $addressExists = CustomerAddress::where('address_id',$address->id);

        // if()
        $product = Order::create([
            'name' => $request['name'],
            'category_code' => $request['category_code'],
            'description' => $request['description'],
            'status' => 'draft',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
    }
}
