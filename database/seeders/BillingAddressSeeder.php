<?php

namespace Database\Seeders;

use App\Models\BillingAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BillingAddress::create([
            'user_id' => 2,
            'address_line_1' => 'no 2 olufemisoro, ondo',
            'city' => 'ondo',
            'post_code' => 301101,
            'state_id' => 1,
            'country_id' => 1
        ]);
    }
}
