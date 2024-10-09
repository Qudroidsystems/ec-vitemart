<?php

namespace Database\Seeders;

use App\Models\Shelf;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shelf::create([
            'name' => 'beverages',
            'slug' => random_int(00000000, 99999999),
            'store_id' => 1
        ]);
        
        Shelf::create([
            'name' => 'watches',
            'slug' => random_int(00000000, 99999999),
            'store_id' => 1
        ]);
    }
}
