<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductPicture;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('status', 'public')->get();

        foreach($products as $item) {
            $item['display_image'] = ProductPicture::where('product_variant_code', $item->id.'-1')->first()->directory;
            $item['rating'] = Review::avg('rating');
            $orderItems = OrderItem::where('product_variant_code', 'like', $item->id.'-%');
            $item['sold'] = $orderItems->sum('qty');
            $item['rating_amount'] = count($orderItems->get());
        }

        $categories = Category::all();

        return view('home', compact(['products','categories']));
    }

    public function search(Request $request)
    {
        $index = $request['index'];
        $product = Product::where('status', 'public')
                          ->where('name', 'LIKE', '%'.$index.'%')->get();

        foreach($product as $item) {
            $item['display_image'] = ProductPicture::where('product_variant_code', $item->id.'-1')->first()->directory;
            $item['rating'] = Review::avg('rating');
            $orderItems = OrderItem::where('product_variant_code', 'like', $item->id.'-%');
            $item['sold'] = $orderItems->sum('qty');
            $item['rating_amount'] = count($orderItems->get());
        }

        return view('search', compact(['product','index']));
    }

    public function product($id)
    {
        $product = Product::find($id);
        $productVariants = ProductVariant::where('product_id', $id)->get();
        $productPictures = ProductPicture::where('product_variant_code', 'LIKE', $id.'-%')->get();
        $product['rating'] = Review::avg('rating');
        $orderItems = OrderItem::where('product_variant_code', 'like', $product->id.'-%');
        $product['sold'] = $orderItems->sum('qty');
        $product['rating_amount'] = count($orderItems->get());
        return view('product', compact(['product','productVariants','productPictures']));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'capture') {
                $order = Order::find($request->order_id);
                $order->update([
                    'payment_status' => 'Paid',
                    'payment_date' => now(),
                ]);

                $orderItems = OrderItem::where('order_code', $order->order_code)->get();

                foreach($orderItems as $item) {
                    $product = ProductVariant::find($item->product_variant_code);
                    $product->update([
                        'stock' => $product->stock - $item->qty,
                    ]);
                }
            }
        }
    }
}
