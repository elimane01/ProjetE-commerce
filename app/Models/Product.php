<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
    protected $fillable = ['name', 'description', 'description_longue', 'price', 'image', 'stock', 'category_id'];
=======
    protected $fillable = ['name', 'description', 'price', 'image', 'stock', 'category_id'];
>>>>>>> 5e86a9d (catalogue produit)

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
