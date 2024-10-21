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
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\City;
use Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDistrict(City $city)
    {
        $districts['districts'] = Address::select('kecamatan')->where('kabupaten', $city->name)->groupBy('kecamatan')->get();
        $districts['subdistricts'] = Address::select('id','kelurahan','kecamatan')->where('kabupaten', $city->name)->get();

        return $districts;
    }

    public function checkOngkir(Request $request)
    {
        $total['weight'] = 0;
        
        foreach($request->cart_item as $cartItem) {
            $variant = ProductVariant::where('product_variant_code', $cartItem)->first();
            $total['weight'] += session('cart')[$cartItem]['qty']*$variant->product->weight_in_gram;
        }

        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 64, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $total['weight'], // berat barang dalam gram
            'courier'       => Shipment::find($request->shipment_id)->shipment_name, // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json($cost);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request)
    {
        $order = '';
        $cart['total_price'] = 0;
        $customer = Customer::where('user_id',Auth::id())->first();
        $address = CustomerAddress::where('customer_id',$customer->id)
                    ->where('city_id',$request['city_destination'])
                    ->where('address_detail',$request['address_detail'])->first();
        if($address == NULL) {
            $address = CustomerAddress::create([
                'customer_id' => $customer->id,
                'city_id' => $request['city_destination'],
                'address_detail' => $request['address_detail'],
            ]);
        }

        if(Order::where('customer_id', $customer->id)->where('status', 'Unpaid')->exists()) {
            $order = Order::where('customer_id', $customer->id)->where('status', 'Unpaid')->first()->delete();
        }
        $order = Order::create([
            'order_code' => str_replace('/','',date('Y/m/d/H/i/s')).rand(pow(10,3),pow(10,4)-1),
            'customer_id' => $customer->id,
            'customer_address_id' => $address->id,
            'payment_id' => 1,
            'shipment_id' => 2,
            'order_date' => now(),
            'shipping_cost' => $request['ongkir'],
            'note' => '',
            'total_price' => 0,
            'status' => 'Unpaid',
            'shipment_status' => 'processing',
        ]);
        
        foreach($request->cart_item as $cartItem) {
            if(!OrderItem::where('order_code',$order->order_code)->where('product_variant_code',$cartItem)->exists()) {
                $cart['items'][$cartItem] = OrderItem::create([
                    'product_variant_code' => $cartItem,
                    'order_code' => $order->order_code,
                    'qty' => session('cart')[$cartItem]['qty'],
                ]);
            }
            $cart['total_price'] += session('cart')[$cartItem]['qty']*$cart['items'][$cartItem]->productVariant->product->price;
        }

        Order::find($order->order_code)->update([
            'total_price' => $cart['total_price'],
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
                'order_id' => $order->order_code,
                'gross_amount' => $order->shipping_cost + $cart['total_price'],
            ),
            'customer_details' => array(
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'email' => $customer->email,
                'phone' => $customer->phone,
            ),
        );

        $transaction = \Midtrans\Snap::createTransaction($params);

        return view('order', compact(['cart','transaction']));
    }

    public function tracking()
    {
        $customer = Customer::where('user_id',Auth::id())->first();
        $orders = Order::where('customer_id', $customer->id)
                       ->where('status', 'Paid')->get();
        $orderItems = [];

        foreach($orders as $order) {
            $orderItems[$order->order_code] = OrderItem::where('order_code',$order->order_code)->get();
        }

        return view('tracking', compact(['orders','orderItems']));
    }
}
