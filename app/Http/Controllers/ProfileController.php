<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\City;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $customer = Customer::where('user_id',Auth::id())->first();
        $myAddresses = CustomerAddress::where('customer_id',$customer->id)->get();
        $addresses = City::orderBy('province_id')->get();

        return view('profile', compact(['customer','addresses','myAddresses']));
    }

    public function update(Request $request, $id) 
    {
        $customer = Customer::find($id)->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['date_of_birth'],
            'phone' => $request['phone'],
        ]);

        return redirect()->route('profile');
    }

    public function addressAdd(Request $request)
    {
        $customer = Customer::where('user_id',Auth::id())->first();

        $request->validate([
            'address_name' => ['required','string','unique:customer_addresses,address_name'],
        ],[
            'address_name' => 'Nama alamat tidak sesuai',
            'address_name.unique' => 'Sudah ada alamat dengan nama tersebut',
        ]);

        if($request['myAddress'] != 'new') {
            CustomerAddress::find($request['myAddress'])->update([
                'address_name' => $request['address_name'],
                'city_id' => $request['province_city'],
                'address_id' => $request['subdistrict'],
                'address_detail' => $request['address_detail'],
            ]);
        } else {
            CustomerAddress::create([
                'customer_id' => $customer->id,
                'address_name' => $request['address_name'],
                'city_id' => $request['province_city'],
                'address_id' => $request['subdistrict'],
                'address_detail' => $request['address_detail'],
            ]);
        }

        return redirect()->route('profile');
    }
}
