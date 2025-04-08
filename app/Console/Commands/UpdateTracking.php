<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UpdateTracking extends Command
{
    protected $signature = 'tracking:update';
    protected $description = 'Update tracking information for orders dynamically every minute';

    public function handle()
    {
        // Find orders with tracking number but not yet delivered
        $orders = Order::whereNotNull('tracking_number')
            ->whereNull('delivered_at')
            ->get();

        foreach ($orders as $order) {
            $history = $order->tracking_history ?? [];
            $lastEvent = end($history) ?: null;


            $statuses = ['Order Processed', 'Shipped', 'In Transit', 'Out for Delivery', 'Delivered'];
            $locations = ['Warehouse #' . rand(1, 5), 'Distribution Center', 'Local Hub', 'Delivery Van', 'Destination'];


            if (!$lastEvent || Carbon::parse($lastEvent['date'])->diffInMinutes(now()) >= 1) {
                $currentIndex = $lastEvent ? array_search($lastEvent['status'], $statuses) : -1;
                $nextIndex = min($currentIndex + 1, count($statuses) - 1);


                $newEvent = [
                    'status' => $statuses[$nextIndex],
                    'date' => now()->toDateTimeString(),
                    'location' => $locations[$nextIndex],
                ];

                $history[] = $newEvent;
                $order->tracking_history = $history;

                // Update shipped_at or delivered_at
                if ($newEvent['status'] === 'Shipped' && !$order->shipped_at) {
                    $order->shipped_at = now();
                } elseif ($newEvent['status'] === 'Delivered') {
                    $order->delivered_at = now();
                    $order->status = 'delivered';
                }

                $order->save();

                $this->info("Updated tracking for Order #{$order->id} to {$newEvent['status']}");
            }
        }

        $this->info('Tracking update completed.');
    }
}
