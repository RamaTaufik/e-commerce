<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductPicture;
use App\Models\ProductVariant;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Cirno Fumo - Touhou Project',
            'category_code' => 'PLS-FM',
            'price' => 399000,
            'stock' => 99,
            'status' => 'public',
        ]);
        ProductPicture::create([
            'product_id' => 1,
            'directory' => '1/main.jpg',
        ]);
        ProductPicture::create([
            'product_id' => 1,
            'directory' => '1/dis1.jfif',
        ]);
        ProductVariant::create([
            'product_variant_code' => '1-1',
            'product_id' => 1,
            'size(cm)' => 'md.14-14-23',
            'weight(g)' => 'md.119',
        ]);
    }
}
