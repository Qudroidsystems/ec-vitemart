<?php

namespace Database\Seeders;

use App\Models\Upload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Upload::create([
            'name' => 'user_avatar',
            'ext' => 'jpg'
        ]);
        Upload::create([
            'name' => 'product_default',
            'ext' => 'jpg'
        ]);
        Upload::create([
            'name' => 'category_default',
            'ext' => 'jpg'
        ]);
        Upload::create([
            'name' => 'store_default',
            'ext' => 'jpg'
        ]);
    }
}
