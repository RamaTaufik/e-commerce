<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\Review;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $orders = Order::where('status','Processing');

        if($request->input('search')) {
            $orders = $orders->where('name', 'LIKE', '%'.$request->input('search').'%');
        }

        if($request->input('from')) {
            $orders = $orders->where('created_at', '>', $request->input('from'));
        }

        if($request->input('pagination')) {
            $orders = $orders->paginate($request->input('pagination'));
        } else {
            $orders = $orders->paginate('20');
        }

        $orderItems = [];

        foreach($orders as $order) {
            $orderItems[$order->order_code] = OrderItem::where('order_code',$order->order_code)->get();
        }

        return view('admin.order', compact(['orders','orderItems','request']));
    }

    public function shipment(Request $request)
    {
        $orders = Order::where('status','!=','Processing')
                       ->where('status','!=','Cancelled')
                       ->where('status','!=','Returning')
                       ->where('status','!=','Cancelling');

        if($request->input('search')) {
            $orders = $orders->where('name', 'LIKE', '%'.$request->input('search').'%');
        }

        if($request->input('from')) {
            $orders = $orders->where('created_at', '>', $request->input('from'));
        }

        if($request->input('pagination')) {
            $orders = $orders->paginate($request->input('pagination'));
        } else {
            $orders = $orders->paginate('20');
        }

        $orderItems = [];

        foreach($orders as $order) {
            $orderItem = OrderItem::where('order_code',$order->order_code)->get();
            $i = 1;
            foreach($orderItem as $item) {
                $product_variant = ProductVariant::where('product_variant_code', $item->product_variant_code)->first();
                $orderItems[$order->order_code][$i]['name'] = $product_variant->product->name;
                $orderItems[$order->order_code][$i]['variation'] = $product_variant->variation;
                $orderItems[$order->order_code][$i]['price'] = $product_variant->price;
                $orderItems[$order->order_code][$i]['qty'] = $item->qty;
                $i++;
            }
        }

        return view('admin.order-shipment', compact(['orders','orderItems','request']));
    }

    public function ship($code)
    {
        $order = Order::find($code);
        $order->status = 'Shipping';
        $order->save();

        return redirect()->route('admin.order-shipment');
    }

    public function cancelled()
    {
        $orders = Order::where('status','Cancelled')
                       ->orWhere('status', 'Returning')
                       ->orWhere('status', 'Cancelling')->get();
        $orderItems = [];

        foreach($orders as $order) {
            $orderItem = OrderItem::where('order_code',$order->order_code)->get();
            $i = 1;
            foreach($orderItem as $item) {
                $product_variant = ProductVariant::where('product_variant_code', $item->product_variant_code)->first();
                $orderItems[$order->order_code][$i]['name'] = $product_variant->product->name;
                $orderItems[$order->order_code][$i]['variation'] = $product_variant->variation;
                $orderItems[$order->order_code][$i]['price'] = $product_variant->price;
                $orderItems[$order->order_code][$i]['qty'] = $item->qty;
                $i++;
            }
        }

        return view('admin.order-cancelled', compact('orders','orderItems'));
    }

    public function confirmCancel(Request $request, $order)
    {
        if($request['status'] == 'Confirm') {
            $order->update([
                'note' => '',
                'status' => file_exists(asset('image/return_proof/'.$order->order_code.'/proof.png')) ? 'Returning' : 'Cancelled',
            ]);
        } else {
            $order->update([
                'note' => '[No'.$request['forbid'].']%%%'.$request['reason'],
                'status' => $request['status'],
            ]);
        }

        return redirect()->route('admin.order-cancelled');
    }

    public function arrived($code)
    {
        $order = Order::find($code);
        $order->status = 'Arrived';
        $order->save();

        return redirect()->route('admin.order-shipment');
    }

    public function reviews(Request $request)
    {
        // if($request->input('search')) {
        //     $orders = $orders->where('name', 'LIKE', '%'.$request->input('search').'%');
        // }

        if($request->input('from')) {
            $reviews = Review::where('created_at', '>', $request->input('from'));
        } else {
            $reviews = Review::where('created_at', '>', '0000-00-00');
        }

        if($request->input('pagination')) {
            $reviews = $reviews->paginate($request->input('pagination'));
        } else {
            $reviews = $reviews->paginate('20');
        }

        return view('admin.order-reviews', compact(['reviews','request']));
    }
}
