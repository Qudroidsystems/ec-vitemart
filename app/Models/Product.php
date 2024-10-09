<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['cover', 'tags', 'brands', 'store', 'media'];

    public function tags() {
        return $this->morphToMany(Tag::class, 'taggable', 'taggings');
    }

    public function brands() {
        return $this->morphToMany(Brand::class, 'brandable', 'brandings');
    }
    
    public function media() {
        return $this->morphToMany(Upload::class, 'to', 'uploadings');
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'product_id');
    }
    
    public function cover() {
        return $this->belongsTo(Upload::class, 'cover_id');
    }

    public function store() {
        return $this->belongsToMany(Store::class);
    }
}
