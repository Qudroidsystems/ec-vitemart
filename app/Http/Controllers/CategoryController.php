<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin/Category/categories', [
            ...bag::get_bag(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin/Category/add', [
            ...bag::get_bag(),
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create($request->validate([
            'name' => ['required', 'unique:categories,name,except,id'],
            'description' => ['max:250'],
            'status' => ['required'],
        ]));
        
        if(isset($request['file'])) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $slug = uniqid();
            $path = $slug . $extension;
            move_uploaded_file($request->file('file'), '../public/uploads/' . $path);
            $category->cover = $path;
    
    
            $category->save();
        }
        
        if($category) return [true, $category];
        
        return [false];
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('Admin.Category.edit', [
            'category' => $category,
            ...bag::get_bag(),
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug = null)
    {
        return view('Admin/Category/edit', [
            'category' => $slug ? Category::where('id', $slug)->first() : null,
            ...bag::get_bag(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        if($request->file('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $slug = uniqid();
            $path = $slug . $extension;
            move_uploaded_file($request->file('file'), '../public/uploads/' . $path);
            $category->cover = $path;
    
    
            $category->save();
        }

        Category::updateOrCreate(
            ['id' => $category->id],
            [
                'name' => $request['name'],
                'description' => $request['description'],
                'status' => $request['status'],
            ]
        );

        return [true];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if(sizeof($category->products) == 0) {
            $category->delete();
            return [true];
        }
        
        return [false];

    }
}
