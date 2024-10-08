<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function registerAccount(string $email)
    {
        return view('auth.register-customer')->with(compact('email'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'Fname' => ['required', 'string', 'max:255'],
            'Lname' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
        ], [
            'email.unique' => 'Email sudah digunakan',
            'password' => 'Password tidak sesuai',
            'Fname' => 'Nama depan tidak sesuai',
            'Lname' => 'Nama belakang tidak sesuai',
            'gender' => 'Perlu diisi',
            'date_of_birth' => 'Perlu diisi',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'user_type' => 'c',
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($data['password']),
        ]);

        Customer::create([
            'user_id' => $user->id,
            'Fname' => $data['Fname'],
            'Lname' => $data['Lname'],
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'phone' => $data['phone'],
        ]);

        return $user;
    }
}