<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'city',
        'zip_code',
        'country',
        'state',
        'shipping_method',
        'payment_method',  // Add this
        'payment_details', // Add this
        'items',
        'subtotal',
        'tax',
        'shipping',
        'total',
        'status'
    ];
    protected $casts = [
        'items' => 'array'
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
