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
        $product1 = Product::create([
            'name' => 'Cirno Fumo - Touhou Project',
            'category_code' => 'PLS-FM',
            'description' => 'Lorem ipsum dolor sit amet',
            'material' => 'Katun',
            'status' => 'public',
        ]);
        ProductVariant::create([
            'product_variant_code' => $product1->id.'-1',
            'product_id' => 1,
            'variation' => 'base',
            'size_in_cm' => '14-14-23',
            'weight_in_gram' => 119,
            'price' => 399000,
            'stock' => "99",
        ]);
        ProductPicture::create([
            'product_variant_code' => $product1->id.'-1',
            'directory' => $product1->id.'-1/1.jpg',
        ]);
        $product2 = Product::create([
            'name' => 'Reimu Fumo - Touhou Project',
            'category_code' => 'PLS-FM',
            'description' => 'Lorem ipsum dolor sit amet',
            'material' => 'Katun',
            'status' => 'public',
        ]);
        ProductVariant::create([
            'product_variant_code' => $product2->id.'-1',
            'product_id' => 2,
            'variation' => 'base',
            'size_in_cm' => '14-14-23',
            'weight_in_gram' => 119,
            'price' => 420000,
            'stock' => "77",
        ]);
        ProductPicture::create([
            'product_variant_code' => $product2->id.'-1',
            'directory' => $product2->id.'-1/1.jpg',
        ]);
        $product3 = Product::create([
            'name' => 'Nian Bean - Arknights',
            'category_code' => 'PLS-BN',
            'description' => 'Nian bean plushie from the hit Chinese gacha game Arknights.',
            'material' => 'Katun',
            'status' => 'public',
        ]);
        ProductVariant::create([
            'product_variant_code' => $product3->id.'-1',
            'product_id' => 3,
            'variation' => 'base',
            'size_in_cm' => '35-35-48',
            'weight_in_gram' => 1000,
            'price' => 250000,
            'stock' => "83",
        ]);
        ProductPicture::create([
            'product_variant_code' => $product3->id.'-1',
            'directory' => $product3->id.'-1/1.webp',
        ]);
    }
}
