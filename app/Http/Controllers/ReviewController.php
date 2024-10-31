<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\OrderItem;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        $review = Review::create([
            'order_item_id' => $request->order_item_id,
            'customer_review' => $request->customer_review,
            'rating' => $request->rating,
        ]);
        
        if($request->hasFile('picture')) {
            $orderItem = OrderItem::find($request->order_item_id);
            $dir = 'image/reviews/'.$orderItem->productVariant->product_variant_code.'/';
            if(!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            } 
            $image = $request->file('picture');
            foreach($image as $img) {
                $fileName = $orderItem->order_code.'.'.$img->getClientOriginalExtension();
                $img->move(public_path($dir), $fileName);
                $review->update([
                    'picture' => $orderItem->productVariant->product_variant_code.'/'.$fileName,
                ]);
            }
        }

        return back()->with('Review berhasil ditambah');
    }
}
