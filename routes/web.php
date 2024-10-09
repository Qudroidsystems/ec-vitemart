<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//General
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'five_categories' => Category::paginate(5),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'three_top_deals' => Product::orderBy('discount', 'ASC')->paginate(4),
        'trending_products' => View::paginate(8),
        'new_arrivals' => Product::orderBy('id', 'desc')->paginate(8)
    ]);
})->name('welcome');

Route::get('/categories', function () {
    return Inertia::render('Products');
})->middleware(['auth', 'verified'])->name('products');

Route::get('/category/{slug}', function ($slug) {
    return Inertia::render('Category');
})->middleware(['auth', 'verified'])->name('category');

Route::get('/product/{slug}', function ($slug) {
    return Inertia::render('Product');
})->middleware(['auth', 'verified'])->name('product');

Route::get('/shop', function () {
    return Inertia::render('Shop', [
        'categories' => Category::with('products')->get(),
        'deals' => Product::where('discount', '>', 25)->where('discount_type', 'percentage')->get()
    ]);
})->middleware(['auth', 'verified'])->name('shop');

Route::get('/blog', function () {
    return Inertia::render('Blog');
})->middleware(['auth', 'verified'])->name('blog');

Route::get('/about', function () {
    return Inertia::render('About');
})->middleware(['auth', 'verified'])->name('about');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->middleware(['auth', 'verified'])->name('contact');

Route::get('/coupons', function () {
    return Inertia::render('Coupons');
})->middleware(['auth', 'verified'])->name('coupons');

Route::get('/order-tracking', function() {
    return Inertia::render('OrderConfirmation');
})->middleware(['auth', 'verified'])->name('order-tracking');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




/////////
//SuperAdmin & Admin//
/////////
Route::post('/admin-uploads', [ UploadController::class, 'upload' ])->name('admin-uploads');

Route::get('/admin-get-all-categories', function () {
    return Category::all();
})->middleware(['auth', 'verified'])->name('admin-get-all-categories');

Route::middleware(['auth', 'verified'])->group(function () {
    //
});

//Dashboard
Route::get('/admin-dashboard', function () {
    return view('Admin/dashboard', [
        'categories' => Category::all(),
        'products' => Product::all(),
        'brands' => Brand::all()
    ]);
})->name('admin-dashboard');

// Catalog
//Store
Route::get('/admin-all-stores', [StoreController::class, 'index'])->middleware(['auth', 'verified'])->name('admin-all-stores');

Route::get('/admin-add-store', [StoreController::class, 'create'])->middleware(['auth', 'verified'])->name('admin-add-store');
Route::get('/admin-edit-store/{store}', [StoreController::class, 'show'])->middleware(['auth', 'verified'])->name('admin-edit-store');

Route::post('/admin-add-store', [StoreController::class, 'store'])->middleware(['auth', 'verified'])->name('admin-add-store');
Route::post('/admin-update-store/{store}', [StoreController::class, 'update'])->middleware(['auth', 'verified'])->name('admin-update-store');
Route::delete('/admin-delete-store/{store}', [StoreController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin-delete-store');

// //Shipping Zone
// Route::get('/admin-all-stores', [StoreController::class, 'index'])->middleware(['auth', 'verified'])->name('admin-all-stores');

// Route::get('/admin-add-store', [StoreController::class, 'create'])->middleware(['auth', 'verified'])->name('admin-add-store');
// Route::get('/admin-edit-store/{store}', [StoreController::class, 'show'])->middleware(['auth', 'verified'])->name('admin-edit-store');

// Route::post('/admin-add-store', [StoreController::class, 'store'])->middleware(['auth', 'verified'])->name('admin-add-store');
// Route::post('/admin-update-store/{store}', [StoreController::class, 'update'])->middleware(['auth', 'verified'])->name('admin-update-store');
// Route::delete('/admin-delete-store/{store}', [StoreController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin-delete-store');

//Category
Route::get('/admin-all-categories', [CategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('admin-all-categories');

Route::get('/admin-add-category', [CategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('admin-add-category');
Route::get('/admin-edit-category/{category}', [CategoryController::class, 'show'])->middleware(['auth', 'verified'])->name('admin-edit-category');

Route::post('/admin-add-category', [CategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('admin-add-category');
Route::post('/admin-update-category/{category}', [CategoryController::class, 'update'])->middleware(['auth', 'verified'])->name('admin-update-category');
Route::delete('/admin-delete-category/{category}', [CategoryController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin-delete-category');

//Product
Route::get('/admin-all-products', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('admin-all-products');

Route::get('/admin-add-product', [ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('admin-add-product');
Route::get('/admin-edit-product/{product}', [ProductController::class, 'show'])->middleware(['auth', 'verified'])->name('admin-edit-product');

Route::post('/admin-add-product', [ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('admin-add-product');
Route::post('/admin-update-product/{product}', [ProductController::class, 'update'])->middleware(['auth', 'verified'])->name('admin-update-product');
Route::delete('/admin-delete-product/{product}', [ProductController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin-delete-product');

// Sale
//Order
Route::get('/admin-all-orders', [OrderController::class, 'index'])->middleware(['auth', 'verified'])->name('admin-sale-all-orders');

Route::get('/admin-add-order', [OrderController::class, 'create'])->middleware(['auth', 'verified'])->name('admin-sale-add-order');
Route::get('/admin-edit-order/{order}', [OrderController::class, 'show'])->middleware(['auth', 'verified'])->name('admin-sale-edit-order');

Route::post('/admin-add-order', [OrderController::class, 'store'])->middleware(['auth', 'verified'])->name('admin-sale-add-order');
Route::post('/admin-update-order/{order}', [OrderController::class, 'update'])->middleware(['auth', 'verified'])->name('admin-sale-update-order');
Route::delete('/admin-delete-order/{order}', [OrderController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin-sale-delete-order');

//Coupon
Route::get('/admin-all-products', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('admin-all-products');

Route::get('/admin-add-product', [ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('admin-add-product');
Route::get('/admin-edit-product/{product}', [ProductController::class, 'show'])->middleware(['auth', 'verified'])->name('admin-edit-product');

Route::post('/admin-add-product', [ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('admin-add-product');
Route::post('/admin-update-product/{product}', [ProductController::class, 'update'])->middleware(['auth', 'verified'])->name('admin-update-product');
Route::delete('/admin-delete-product/{product}', [ProductController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin-delete-product');


// Human Resource
//Admins
Route::get('/admin-all-products', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('admin-all-products');

Route::get('/admin-add-product', [ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('admin-add-product');
Route::get('/admin-edit-product/{product}', [ProductController::class, 'show'])->middleware(['auth', 'verified'])->name('admin-edit-product');

Route::post('/admin-add-product', [ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('admin-add-product');
Route::post('/admin-update-product/{product}', [ProductController::class, 'update'])->middleware(['auth', 'verified'])->name('admin-update-product');
Route::delete('/admin-delete-product/{product}', [ProductController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin-delete-product');

//Dispatchee
Route::get('/admin-all-products', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('admin-all-products');

Route::get('/admin-add-product', [ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('admin-add-product');
Route::get('/admin-edit-product/{product}', [ProductController::class, 'show'])->middleware(['auth', 'verified'])->name('admin-edit-product');

Route::post('/admin-add-product', [ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('admin-add-product');
Route::post('/admin-update-product/{product}', [ProductController::class, 'update'])->middleware(['auth', 'verified'])->name('admin-update-product');
Route::delete('/admin-delete-product/{product}', [ProductController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin-delete-product');


// User Xperience
//Article
Route::get('/admin-all-products', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('admin-all-products');

Route::get('/admin-add-product', [ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('admin-add-product');
Route::get('/admin-edit-product/{product}', [ProductController::class, 'show'])->middleware(['auth', 'verified'])->name('admin-edit-product');

Route::post('/admin-add-product', [ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('admin-add-product');
Route::post('/admin-update-product/{product}', [ProductController::class, 'update'])->middleware(['auth', 'verified'])->name('admin-update-product');
Route::delete('/admin-delete-product/{product}', [ProductController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin-delete-product');


//Settings
Route::get('/admin-edit-configuration', function () {
    return Inertia::render('Admin/Config');
})->middleware(['auth', 'verified'])->name('admin-edit-configuration');


/////////
//Customer//
/////////
Route::get('/checkout', function () {
    return Inertia::render('Checkout');
})->middleware(['auth', 'verified'])->name('checkout');

Route::get('/wishlist', function () {
    return Inertia::render('Wishlist');
})->middleware(['auth', 'verified'])->name('wishlist');

Route::get('/cart', function () {
    return Inertia::render('Cart');
})->middleware(['auth', 'verified'])->name('cart');

Route::get('/order-confirmation/{order}', function ($order) {
    return Inertia::render('OrderConfirmation');
})->middleware(['auth', 'verified'])->name('order-confirmation');

require __DIR__ . '/auth.php';
