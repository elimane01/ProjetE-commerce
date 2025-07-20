<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'description_longue', 'price', 'image', 'stock', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
