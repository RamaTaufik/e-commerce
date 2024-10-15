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
            'size_in_cm' => '14-14-23',
            'weight_in_gram' => 119,
            'material' => 'Katun',
            'price' => 399000,
            'status' => 'public',
        ]);
        ProductVariant::create([
            'product_variant_code' => $product->id.'-1',
            'product_id' => 1,
            'variation' => 'base',
            'stock' => "99",
        ]);
        ProductPicture::create([
            'product_variant_code' => $product->id.'-1',
            'directory' => $product->id.'-1/1.jpg',
        ]);
        ProductPicture::create([
            'product_variant_code' => $product->id.'-1',
            'directory' => $product->id.'-1/2.jfif',
        ]);
    }
}
