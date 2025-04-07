<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address_line_1',
        'address_line_2',
        'region',
        'region_code',
        'province',
        'province_code',
        'city',
        'city_code',
        'barangay',
        'barangay_code',
        'zip_code',
        'shipping_method',
        'payment_method',
        'payment_details',
        'items',
        'subtotal',
        'tax',
        'shipping',
        'total',
        'status',
        'cancelled_at', // Added this to allow mass assignment
    ];

    protected $casts = [
        'payment_details' => 'array',
        'items' => 'array',
        'shipping_details' => 'array',
        'cancelled_at' => 'datetime', // Cast cancelled_at as a datetime
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'cancelled_at', // Ensure proper date handling
    ];

    public function getStatusColorAttribute()
    {
        return [
            'pending' => 'yellow-500',
            'processing' => 'blue-500', // Added processing if you use it
            'completed' => 'green-500',
            'cancelled' => 'red-500',
        ][$this->status] ?? 'gray-500';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getItemsAttribute($value)
    {
        $items = is_array($value) ? $value : json_decode($value, true);

        // Handle case where items might be null or invalid
        if (!is_array($items)) {
            return [];
        }

        // Ensure each item has at least a product_name
        return array_map(function ($item) {
            return array_merge([
                'product_name' => 'Product',
                'quantity' => 1,
                'price' => 0,
                'image' => 'default.jpg'
            ], $item);
        }, $items);
    }

    /**
     * Check if the order can be cancelled
     */
    public function canBeCancelled()
    {
        return $this->payment_method === 'cod' && in_array($this->status, ['pending', 'processing']);
    }
}
