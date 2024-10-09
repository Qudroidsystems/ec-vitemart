<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tagging;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaggingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tagging::create([
            'taggable_id' => 1,
            'taggable_type' => Product::class,
            'tag_id' => 1
        ]);
        Tagging::create([
            'taggable_id' => 1,
            'taggable_type' => Brand::class,
            'tag_id' => 1
        ]);
    }
}
