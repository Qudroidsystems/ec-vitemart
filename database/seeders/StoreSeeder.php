<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'name' => 'Gozak Akure Garage',
            'physical_address' => 'Akure Garage'
        ]);
        Store::create([
            'name' => 'Gozak Adeyemi',
            'physical_address' => 'Adeyemi university'
        ]);
    }
}
