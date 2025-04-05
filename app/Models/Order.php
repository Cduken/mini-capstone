<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address_line_1',  // Changed from 'address'
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
        'status'
    ];

    protected $casts = [
        'payment_details' => 'array',
        'items' => 'array',
        'shipping_details' => 'array'

    ];

    public function getStatusColorAttribute()
    {
        return [
            'pending' => 'yellow-500',
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
}
