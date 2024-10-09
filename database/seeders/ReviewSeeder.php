<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'body' => 'worked exactly as I thought it would',
            'user_id' => 2,
            'product_id' => 1,
            'order_id' => 1,
            'rating' => 4
        ]);
    }
}
