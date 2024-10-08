<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_type' => 'a',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);
        $user = User::create([
            'user_type' => 'c',
            'email' => 'customer@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);
        Customer::create([
            'user_id' => $user->id,
            'first_name' => 'Budiono',
            'last_name' => 'Siregar',
            'gender' => 'm',
            'date_of_birth' => '1979-06-13',
            'phone' => '085851591889',
        ]);
    }
}
