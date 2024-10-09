<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'sneaker',
            'description' => 'this will be a longer description',
            'barcode' => uniqid(),
            'slug' => random_int(00000000, 99999999),
            'shelf_quantity' => 21,
            'rating' => 2,
            'category_id' => 1,
            'retail_price_in_naira' => 4000,
            'sale_price_in_naira' => 2000,
            'discount' => 50,
            'status' => 'public'
        ]);
        Product::create([
            'name' => 'sneaker upgrade 2.0',
            'description' => 'this will be a longer description',
            'barcode' => uniqid(),
            'slug' => random_int(00000000, 99999999),
            'shelf_quantity' => 21,
            'rating' => 5,
            'category_id' => 1,
            'retail_price_in_naira' => 4000,
            'sale_price_in_naira' => 2000,
            'discount' => 150,
            'discount_type' => 'fixed',
            'status' => 'public'
        ]);
    }
}
