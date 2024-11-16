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
use App\Models\Customer;
use App\Models\CustomerAddress;
use Auth;

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
            $item['rating'] = Review::join('order_items', 'reviews.order_item_id', 'order_items.id')
                                       ->where('order_items.product_variant_code', 'LIKE', $item->id.'-%')
                                       ->avg('rating');
            $item['rating_amount'] = count(Review::join('order_items', 'reviews.order_item_id', 'order_items.id')
                                                 ->where('order_items.product_variant_code', 'LIKE', $item->id.'-%')
                                                 ->get());
            $item['sold'] = OrderItem::where('product_variant_code', 'like', $item->id.'-%')->sum('qty');
        }

        $categories = Category::all();

        return view('home', compact(['products','categories']));
    }

    public function search(Request $request)
    {
        $filter['index'] = $request['index'];
        $filter['category'] = $request['category_code'];
        $filter['minPrice'] = $request['minPrice'];
        $filter['maxPrice'] = $request['maxPrice'];
        $product = Product::where('status', 'public')
                          ->where('name', 'LIKE', '%'.$filter['index'].'%');

        if($filter['category'] != '') {
            $product = $product->where('category_code', $filter['category']);
        }
        $product = $product->join('product_variants','products.id','product_variants.product_id')
                            ->where('product_variants.price', '>', $filter['minPrice']);
        if($filter['maxPrice'] != '') {
            $product = $product->where('product_variants.price', '<', $filter['maxPrice']);
        }

        $product = $product->get();

        foreach($product as $item) {
            $item['display_image'] = ProductPicture::where('product_variant_code', $item->id.'-1')->first()->directory;
            $item['rating'] = Review::join('order_items', 'reviews.order_item_id', 'order_items.id')
                                    ->where('order_items.product_variant_code', 'LIKE', $item->id.'-%')
                                    ->avg('rating');
            $item['rating_amount'] = count(Review::join('order_items', 'reviews.order_item_id', 'order_items.id')
                                                 ->where('order_items.product_variant_code', 'LIKE', $item->id.'-%')
                                                 ->get());
            $item['sold'] = OrderItem::where('product_variant_code', 'like', $item->id.'-%')->sum('qty');
        }

        $categories = Category::all();

        return view('search', compact(['product','filter','categories']));
    }

    public function product($id)
    {
        $product = Product::find($id);
        $productVariants = ProductVariant::where('product_id', $id)->get();
        $productPictures = ProductPicture::where('product_variant_code', 'LIKE', $id.'-%')->get();
        $product['rating'] = Review::join('order_items', 'reviews.order_item_id', 'order_items.id')
                                   ->where('order_items.product_variant_code', 'LIKE', $product->id.'-%')
                                   ->avg('rating');
        $product['rating_amount'] = count(Review::join('order_items', 'reviews.order_item_id', 'order_items.id')
                                   ->where('order_items.product_variant_code', 'LIKE', $product->id.'-%')
                                   ->get());
        $product['sold'] = OrderItem::where('product_variant_code', 'like', $product->id.'-%')->sum('qty');
        $reviews = Review::join('order_items', 'reviews.order_item_id', 'order_items.id')
                         ->where('order_items.product_variant_code', 'LIKE', $product->id.'-%')
                         ->get();
        return view('product', compact(['product','productVariants','productPictures','reviews']));
    }

    public function profile()
    {
        $this->middleware('auth');

        $customer = Customer::where('user_id',Auth::id())->first();
        $addresses = CustomerAddress::where('customer_id',$customer->id)->get();

        return view('profile', compact(['customer','addresses']));
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

                $cart = [];
                session()->put('cart', $cart);
            }
        }
    }
}
