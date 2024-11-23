<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $card['processing'] = Order::where('status', 'Processing')->count();
        $card['cancelling'] = Order::where('status', 'Cancelling')->count();
        $card['this_month_omzet'] = number_format(Order::where('order_date', '>', date('Y-m-01'))->sum('total_price'));

        return view('admin.home', compact(['card']));
    }

    public function report(Request $request)
    {
        $orders = Order::where('order_date', '>', '0000-00-00');
        if($request->input('timespan') == NULL) {
            $orders = Order::where('order_date', '>', date_sub(now(), date_interval_create_from_date_string('7 days')));
        } else if($request->input('timespan') != 'all') {
            $orders = Order::where('order_date', '>', date_sub(now(), date_interval_create_from_date_string($request->input('timespan').' days')));
        }

        $orderItems = OrderItem::whereIn('order_code', $orders->pluck('order_code'));
        $statistics = [];

        $statistics['net_sum'] = number_format($orders->sum('total_price'),0,'.',',');
        $statistics['net_avg'] = number_format($orders->avg('total_price'),0,'.',',');
        $statistics['done'] = $orders->count() - $orders->where('status', 'cancelled')->count();
        $statistics['cancelled'] = $orders->where('status', 'cancelled')->count();
        $statistics['total'] = $statistics['done'] + $statistics['cancelled'];
        $statistics['qty_sum'] = number_format($orderItems->sum('qty'),0,'.',',');
        $statistics['qty_avg'] = number_format($orderItems->avg('qty'),1,'.',',');

        $statistics['100'] = [
            'max' => '',
            'total_qty' => '',
            'qty' => '',
            'total' => '',
        ];

        return view('admin.report', compact(['statistics','request']));
    }
}
