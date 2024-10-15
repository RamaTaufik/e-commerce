<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shipment;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shipment::create([
            'shipment_name' => 'jne',
            'email' => 'customercare@jne.co.id"',
            'phone' => '02129278888',
        ]);
        Shipment::create([
            'shipment_name' => 'tiki',
            'email' => 'tiki@tiki.id',
            'phone' => '1500125',
        ]);
        Shipment::create([
            'shipment_name' => 'pos',
            'email' => 'halopos@posindonesia.co.id',
            'phone' => '1500161',
        ]);
    }
}
