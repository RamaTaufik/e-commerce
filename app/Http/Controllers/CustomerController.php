<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $customers = Customer::with('user');

        if($request->input('search')) {
            $customers = $customers->where('first_name', 'LIKE', '%'.$request->input('search').'%')
                                   ->orWhere('last_name', 'LIKE', '%'.$request->input('search').'%');
        }

        if($request->input('sort') == 'terbaru') {
            $customers = $customers->orderBy('created_at', 'DESC');
        } else {
            $customers = $customers->orderBy('created_at');
        }

        if($request->input('pagination')) {
            $customers = $customers->paginate($request->input('pagination'));
        } else {
            $customers = $customers->paginate('20');
        }

        return view('admin.customers', compact(['customers','request']));
    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        return view('admin.customer-edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['date_of_birth'],
            'phone' => $request['phone'],
        ]);

        $user = User::find($customer->user_id);
        if($user->email != $request['email']) {
            $user->update([
                'email' => $request['email'],
                'emai_verified_at' => now(),
            ]);
        }

        return redirect()->route('admin.customers');
    }
    
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $email = $customer->user->email;
        
        $con = mysqli_connect("localhost","root","","plush");

        if(mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        
        $result = mysqli_query($con, "DELETE FROM otps WHERE email = '$email' AND status = 'used'");
        
        User::find($customer->user_id)->delete();

        return redirect()->route('admin.customers');
    }
}
