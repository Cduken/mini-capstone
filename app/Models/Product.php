<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'title',
        'category', // Add this
        'brand_id',
        'price',
        'inStock',
        'image',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class);
    // }




    public function getStockStatusAttribute()
    {
        return $this->inStock ? 'Available' : 'Out of Stock';
    }

    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
}
