<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'category_code' => 'PLS-FM',
            'name' => 'Fumo'
        ]);
        
        Category::create([
            'category_code' => 'PLS-BN',
            'name' => 'Bean'
        ]);
    }
}
