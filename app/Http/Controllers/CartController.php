<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function add(Request $request)
    {
        $data = [$request->qty];
        session([$request->code => $data]);

        return redirect()->route('cart');
    }
}
