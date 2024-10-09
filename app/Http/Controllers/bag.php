<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class bag {
    static public function get_bag() {
        $bag = [];

        if( Auth::user() && !Auth::user()->hasRole('admin') ) {
            //
        }

        return [
            'categories' => Category::all(),
            'stores' => Store::all(),
            'products' => Product::all(),
            'brands' => Brand::all(),
            'tags' => Tag::all(),
            'articles' => Article::class,
            'admin_orders' => Order::where('handler_id', '!=', null)->with('customer')->get(),
            'orders' => Order::with('customer')->get(),
            ...$bag
        ];
    }
} 