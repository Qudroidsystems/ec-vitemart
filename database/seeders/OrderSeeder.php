<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'customer_id' => 2,
            'handler_id' => null,
            'status' => 'completed',
            'total_cost' => 4000,
            'billing_address_id' => 1,
        ]);
        
        Order::create([
            'customer_id' => 2,
            'handler_id' => 1,
            'status' => 'processing',
            'total_cost' => 5000,
            'billing_address_id' => 1,
        ]);
    }
}
