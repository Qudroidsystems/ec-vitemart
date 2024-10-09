<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Electronics',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Computers',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Watches',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Headphones',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Footwear',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Cameras',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Shirts',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Household',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Sandals',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Wines',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Handbags',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Groceries',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Electronics2',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Groceries2',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Electronics3',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Groceries3',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Electronics4',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Groceries4',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Electronics5',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Groceries5',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Electronic6',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Groceries6',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Electronic7',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
        Category::create([
            'name' => 'Groceries7',
            'description' => 'The description is stated here',
            'status' => 'published'
        ]);
    }
}
