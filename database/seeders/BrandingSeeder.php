<?php

namespace Database\Seeders;

use App\Models\Branding;
use App\Models\BrandProduct;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branding::create([
            'brand_id' => 1,
            'brandable_id' => 1,
            'brandable_type' => Product::class
        ]);
        Branding::create([
            'brand_id' => 1,
            'brandable_id' => 1,
            'brandable_type' => Store::class
        ]);
    }
}
