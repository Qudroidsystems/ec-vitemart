<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['cover'];

    public function products() {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function cover() {
        return $this->belongsTo(Upload::class, 'cover_id');
    }
}
