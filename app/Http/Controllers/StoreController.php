<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use App\Models\Upload;
use App\Models\Uploading;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin/Store/stores', [
            ...bag::get_bag()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {
        return view('Admin.Store.add', [
            'tags' => Tag::all(),
            'stores' => Store::all(),
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = $request;

        $created = Store::create($request->validate([
            'name' => ['required', 'unique:categories,name,except,id'],

        ]));

        if(isset($request['file'])) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $slug = uniqid();
            $path = $slug . $extension;
            move_uploaded_file($request->file('file'), '../public/uploads/' . $path);
            $created->cover = $path;
    
            $created->save();
        }

        if($created) return[true, $created];
        return [false];
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        return view('Admin.Store.edit', [
            'store' => $store,
            'tags' => Tag::all(),
            'brands' => Brand::all(),
            'products' => Product::all(),
            'stores' => Store::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        if($request->file('cover')) {
            
            $extension = $request->file('cover')->getClientOriginalExtension();
            while (true) {
                $slug = uniqid();
    
                if (!Upload::where('name', $slug)->first()) {
                    $path = $slug . '.' . $extension;
                    move_uploaded_file($request->file('cover'), '../public/uploads/' . $path);
                    
                    $upload = Upload::create([
                        'name' => $slug,
                        'ext' => $extension
                    ]);

                    if($upload) {
                        $store->cover_id = $upload->id;
                        $store->save();
                    }
                    break;
                }

            }
        }

        Store::updateOrCreate(
            ['id' => $store->id],
            [
                'name' => $request['name'],
                'physical_address' => $request['address'],
                'status' => $request['status']
            ]
        );

        if($request->files) {
            foreach(json_decode($request->media) as $f) {
                $upload = Upload::where('name', $f)->first();
                if($upload) {
                    Uploading::create([
                        'upload_id' => $upload->id,
                        'to_id' => $store->id,
                        'to_type' => Store::class
                    ]);
                }
            }
        }

        return [true];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return [true];

    }
}
