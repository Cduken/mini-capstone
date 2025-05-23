<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

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

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function getAverageRatingAttribute(): float
    {
        return (float) $this->ratings()->avg('rating') ?? 0;
    }

    public function getRatingsCountAttribute(): int
    {
        return $this->ratings()->count();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function wishlistedBy()
    {
        return $this->hasMany(Wishlist::class);
    }

    // Optional: Check if the product is wishlisted by the current user
    public function isWishlistedByUser()
    {
        return $this->wishlistedBy()->where('user_id', Auth::id())->exists();
    }
}
