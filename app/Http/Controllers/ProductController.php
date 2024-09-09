<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $product = Product::all();
        foreach($product as $p) {
            $p['category'] = Category::where('category_code', $p['category_code'])->pluck('name');
        }
        return view('admin.product', compact('product'));
    }
}
