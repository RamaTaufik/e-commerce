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
        $product = Product::create([
            'name' => 'Cirno Fumo - Touhou Project',
            'category_code' => 'PLS-FM',
            'description' => 'Lorem ipsum dolor sit amet',
            'status' => 'public',
        ]);
        ProductVariant::create([
            'product_variant_code' => $product->id.'-1',
            'product_id' => 1,
            'size_in_cm' => 'md.14-14-23',
            'weight_in_gram' => 119,
            'material' => 'Katun',
            'price' => 399000,
            'stock_per_color' => "99/NULL",
        ]);
        ProductPicture::create([
            'product_variant_code' => '1-1',
            'directory' => '1-1/1.jpg',
        ]);
        ProductPicture::create([
            'product_variant_code' => '1-1',
            'directory' => '1-1/2.jfif',
        ]);
    }
}
