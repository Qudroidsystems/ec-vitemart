<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $with = ['cover', 'brands', 'tags', 'media'];

    public function cover() {
        return $this->belongsTo(Upload::class, 'cover_id');
    }
        
    public function media() {
        return $this->morphToMany(Upload::class, 'to', 'uploadings');
    }

    public function tags() {
        return $this->morphToMany(Tag::class, 'taggable', 'taggings');
    }

    public function brands() {
        return $this->morphToMany(Brand::class, 'brandable', 'brandings');
    }

    public function categories() {
        return $this->morphToMany(Category::class, 'categoryable', 'categoryings');
    }
}