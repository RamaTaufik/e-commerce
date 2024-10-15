<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::where('shipment_status','Processing')->get();
        $orderItems = [];

        foreach($orders as $order) {
            $orderItems[$order->order_code] = OrderItem::where('order_code',$order->order_code)->get();
        }

        return view('admin.order', compact(['orders','orderItems']));
    }

    protected function shipment()
    {
        $orders = Order::where('shipment_status','Shipping')->orWhere('shipment_status','Arrived')->get();
        $orderItems = [];

        foreach($orders as $order) {
            $orderItems[$order->order_code] = OrderItem::where('order_code',$order->order_code)->get();
        }

        return view('admin.order-shipment', compact('orders','orderItems'));
    }

    protected function ship($code)
    {
        $order = Order::find($code);
        $order->shipment_status = 'Shipping';
        $order->save();

        return redirect()->route('admin.order-shipment');
    }
}
