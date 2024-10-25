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
        $orders = Order::where('status','Processing')->get();
        $orderItems = [];

        foreach($orders as $order) {
            $orderItems[$order->order_code] = OrderItem::where('order_code',$order->order_code)->get();
        }

        return view('admin.order', compact(['orders','orderItems']));
    }

    protected function shipment()
    {
        $orders = Order::where('status','!=','Processing')->where('status','!=','Cancelled')->get();
        $orderItems = [];

        foreach($orders as $order) {
            $orderItems[$order->order_code] = OrderItem::where('order_code',$order->order_code)->get();
        }

        return view('admin.order-shipment', compact('orders','orderItems'));
    }

    protected function cancelled()
    {
        $orders = Order::where('status','Cancelled')->get();
        $orderItems = [];

        foreach($orders as $order) {
            $orderItems[$order->order_code] = OrderItem::where('order_code',$order->order_code)->get();
        }

        return view('admin.order-shipment', compact('orders','orderItems'));
    }

    protected function ship($code)
    {
        $order = Order::find($code);
        $order->status = 'Shipping';
        $order->save();

        return redirect()->route('admin.order-shipment');
    }
}
