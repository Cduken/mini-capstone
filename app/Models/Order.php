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
        'cancelled_at',
        'tracking_number',      // Added for tracking
        'tracking_history',     // Added for tracking
        'shipped_at',           // Added for tracking
        'delivered_at',         // Added for tracking
    ];

    protected $casts = [
        'payment_details' => 'array',
        'items' => 'array',
        'shipping_details' => 'array',
        'tracking_history' => 'array',  // Added to cast JSON tracking_history
        'cancelled_at' => 'datetime',
        'shipped_at' => 'datetime',     // Added to cast shipped_at as datetime
        'delivered_at' => 'datetime',   // Added to cast delivered_at as datetime
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'cancelled_at',
        'shipped_at',           // Added to ensure proper date handling
        'delivered_at',         // Added to ensure proper date handling
    ];

    public function getStatusColorAttribute()
    {
        return [
            'pending' => 'yellow-500',
            'processing' => 'blue-500',
            'completed' => 'green-500',
            'cancelled' => 'red-500',
            'shipped' => 'purple-500',  // Added for tracking status
            'delivered' => 'green-600', // Added for tracking status
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
        return $this->payment_method === 'cod' &&
            in_array($this->status, ['pending', 'processing']) &&
            !$this->shipped_at;  // Updated to prevent cancellation after shipping
    }

    /**
     * Get the current tracking status
     */
    public function isTrackingMoving()
    {
        // If there's no tracking history or it's empty, it's likely dummy
        if (empty($this->tracking_history) || !is_array($this->tracking_history)) {
            return false;
        }

        // If there's only one entry and no shipped/delivered timestamps, it's static
        if (count($this->tracking_history) <= 1 && !$this->shipped_at && !$this->delivered_at) {
            return false;
        }

        // Check if there are multiple updates with reasonable time gaps
        $history = $this->tracking_history;
        if (count($history) > 1) {
            $timestamps = array_column($history, 'date');
            $firstUpdate = new \DateTime($timestamps[0]);
            $lastUpdate = new \DateTime(end($timestamps));
            $interval = $firstUpdate->diff($lastUpdate);

            // If updates span more than a few hours or days, it’s moving
            return $interval->h > 1 || $interval->d > 0;
        }

        // If shipped_at or delivered_at exists with history, assume it’s moving
        return $this->shipped_at || $this->delivered_at;
    }

    // Existing getTrackingStatus method (for reference)
    public function getTrackingStatus()
    {
        if ($this->delivered_at) {
            return 'Delivered';
        } elseif ($this->shipped_at) {
            return 'Shipped';
        } elseif ($this->status === 'processing') {
            return 'Processing';
        } elseif ($this->status === 'completed') {
            return 'Completed';
        } elseif ($this->status === 'cancelled') {
            return 'Cancelled';
        } else {
            return 'Pending';
        }
    }


}
