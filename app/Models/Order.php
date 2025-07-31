<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total', 'status',
        'payment_method', 'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    // Calcul dynamique du total de la commande
    public function getCalculatedTotalAttribute()
    {
        return $this->products->sum(function($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
    }
} 