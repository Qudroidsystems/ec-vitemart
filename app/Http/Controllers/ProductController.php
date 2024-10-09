<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Branding;
use App\Models\BrandProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStore;
use App\Models\ProductTag;
use App\Models\Store;
use App\Models\Tag;
use App\Models\Tagging;
use App\Models\Upload;
use App\Models\Uploading;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * This method returns the product listing view with additional data from `bag::get_bag()`.
     */
    public function index()
    {
        return view('Admin/Product/products', [
            ...bag::get_bag(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * This method returns the view for adding a new product.
     */
    public function create(Request $request) {
        return view('Admin.Product.add', [
            ...bag::get_bag(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * This method handles creating a new product in the database.
     * It calculates the sale price based on discount type (percentage/fixed).
     */
    public function store(Request $request)
    {
        $product = $request;

        $sale_price = null;

        // Calculate the sale price based on the discount type
        switch ($product['discount_type']) {
            case 'percentage':
                // If discount type is percentage, reduce the price by the percentage discount
                $sale_price = $product['retail_price_in_naira'] - ($product['retail_price_in_naira'] * ($product['discount'] / 100));
                break;

            case 'fixed':
                // If discount type is fixed, reduce the price by a fixed amount
                $sale_price = $product['retail_price_in_naira'] - $product['discount'];
                break;

            default:
                // If no discount, use the retail price as the sale price
                $sale_price = $product['retail_price_in_naira'];
                break;
        }

        // Create a new product entry after validating the input
        $created = Product::create($request->validate([
            'name' => ['required', 'unique:categories,name,except,id'],  // Ensure product name is unique
            'description' => ['max:500'],  // Limit description length to 500 characters
            'status' => ['required'],  // Status is required
            'description' => $product['description'],
            'allow_backorders' => $product['allow_backorders'],
            'slug' => $product['sku'],
            'barcode' => $product['barcode'],
            'shelf_quantity' => $product['shelf_quantity'],
            'warehouse_quantity' => $product['warehouse_quantity'],
            'category_id' => $product['category_id'] ?? null,  // Nullable field for category
            'brand_id' => $product['brand_id'] ?? null,  // Nullable field for brand
            'retail_price_in_naira' => $product['retail_price_in_naira'],
            'sale_price_in_naira' => $sale_price,  // Calculated sale price
            'discount_type' => $product['discount_type'],
            'discount' => $product['discount'] ?? null,
            'physical' => $product['physical'] ?? null,  // Whether the product is physical or not
            'weight' => $product['physical'] ? $product['weight'] ?? null : null,
            'height' => $product['physical'] ? $product['height'] ?? null : null,
            'width' => $product['physical'] ? $product['width'] ?? null : null,
            'length' => $product['physical'] ? $product['length'] ?? null : null,
            'template' => $product['template'] ?? null,
        ]));

        // Handle file upload if a file is present in the request
        if(isset($request['file'])) {
            $extension = $request->file('file')->getClientOriginalExtension();  // Get the file extension
            $slug = uniqid();  // Generate a unique ID
            $path = $slug . $extension;
            move_uploaded_file($request->file('file'), '../public/uploads/' . $path);  // Move the file to the uploads folder
            $created->cover = $path;  // Set the cover path for the product

            $created->save();  // Save the product details
        }

        // Return a success response if the product is created
        if($created) return [true, $created];
        return [false];
    }

    /**
     * Display the specified resource.
     * This method returns the edit view for the specified product.
     */
    public function show(Product $product)
    {
        return view('Admin.Product.edit', [
            'product' => $product,  // Pass the product details to the view
            ...bag::get_bag(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * This method handles updating an existing product's details.
     */
    public function update(Request $request, Product $product)
    {
        // Handle cover image upload if a new cover is provided
        if($request->file('cover')) {
            $extension = $request->file('cover')->getClientOriginalExtension();  // Get the file extension
            while (true) {
                $slug = uniqid();  // Generate a unique slug

                if (!Upload::where('name', $slug)->first()) {
                    $path = $slug . '.' . $extension;  // Create the file path
                    move_uploaded_file($request->file('cover'), '../public/uploads/' . $path);  // Move the file to the uploads folder

                    $upload = Upload::create([
                        'name' => $slug,
                        'ext' => $extension
                    ]);  // Create an upload entry

                    if($upload) {
                        $product->cover_id = $upload->id;  // Set the cover ID for the product
                        $product->save();  // Save the product
                    }

                    break;
                }
            }
        }

        // Handle updating tags associated with the product
        if($request->tags) {
            Tagging::where('taggable_id', $product->id)->where('taggable_type', Product::class)->delete();  // Remove existing tags
            foreach (json_decode($request->tags) as $t) {
                $tag = Tag::where('name', $t)->first();
                if(!$tag) {
                    $tag = Tag::create([
                        'name' => $t
                    ]);  // Create a new tag if it doesn't exist
                }

                Tagging::create([
                    'taggable_id' => $product->id,
                    'taggable_type' => Product::class,
                    'tag_id' => $tag->id
                ]);  // Assign the tag to the product
            }
        }

        // Handle updating brands associated with the product
        if($request->brands) {
            Branding::where('brandable_id', $product->id)->where('brandable_type', Product::class)->delete();  // Remove existing brands
            foreach (json_decode($request->brands) as $b) {
                $brand = Brand::where('name', $b)->first();
                if(!$brand) {
                    $brand = Brand::create([
                        'name' => $b
                    ]);  // Create a new brand if it doesn't exist
                }

                Branding::create([
                    'brandable_id' => $product->id,
                    'brandable_type' => Product::class,
                    'brand_id' => $brand->id
                ]);  // Assign the brand to the product
            }
        }

        // Handle media files associated with the product
        if($request->files) {
            foreach(json_decode($request->media) as $f) {
                $upload = Upload::where('name', $f)->first();
                if($upload) {
                    Uploading::create([
                        'upload_id' => $upload->id,
                        'to_id' => $product->id,
                        'to_type' => Product::class
                    ]);  // Link media files to the product
                }
            }
        }

        // Calculate the sale price based on the discount type
        $sale_price = null;
        switch ($request['discount_type']) {
            case 'percentage':
                $sale_price = $request['retail_price_in_naira'] - ($request['retail_price_in_naira'] * ($product['discount'] / 100));
                break;

            case 'fixed':
                $sale_price = $request['retail_price_in_naira'] - $request['discount'];
                break;

            default:
                $sale_price = $request['retail_price_in_naira'];
                break;
        }

        // Update or create the product with the new data
        Product::updateOrCreate(
            ['id' => $product->id],  // Find product by ID
            [
                'name' => $request['name'],
                'description' => $request['description'],
                'status' => $request['status'],
                'allow_backorders' => $request['allow_backorders'],
                'slug' => $request['sku'],
                'barcode' => $request['barcode'],
                'shelf_quantity' => $request['shelf_quantity'],
                'warehouse_quantity' => $request['warehouse_quantity'],
                'category_id' => $request['category_id'] ?? null,
                'retail_price_in_naira' => $request['retail_price_in_naira'],
                'sale_price_in_naira' => $sale_price,  // Set the sale price
                'discount_type' => $request['discount_type'],
                'discount' => $request['discount'] ?? null,
                'physical' => $request['physical'] ?? null,
                'weight' => $request['physical'] ? $request['weight'] ?? null : null,
                'height' => $request['physical'] ? $request['height'] ?? null : null,
                'width' => $request['physical'] ? $request['width'] ?? null : null,
                'length' => $request['physical'] ? $request['length'] ?? null : null,
                'template' => $request['template'] ?? null,
            ]
        );

        return [true];  // Return a success response
    }

    /**
     * Remove the specified resource from storage.
     * This method handles deleting a product and its related entries.
     */
    public function destroy(Product $product)
    {
        $product_stores = ProductStore::where('product_id', $product->id)->get();  // Find related product-store entries

        foreach($product_stores as $pt) {
            $pt->delete();  // Delete all related product-store entries
        }

        $product->delete();  // Delete the product itself
        return [true];  // Return a success response
    }
}
