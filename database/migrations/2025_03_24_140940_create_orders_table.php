<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();

            // Customer information
            $table->string('name');
            $table->string('email');

            // Address fields
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->string('region');
            $table->string('region_code', 10);
            $table->string('province');
            $table->string('province_code', 10);
            $table->string('city');
            $table->string('city_code', 10);
            $table->string('barangay');
            $table->string('barangay_code', 10);
            $table->string('zip_code', 10);

            // Shipping and payment
            $table->string('shipping_method');
            $table->string('payment_method');
            $table->json('payment_details')->nullable();

            // Order items and totals
            $table->json('items');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('shipping', 10, 2);
            $table->decimal('total', 10, 2);

            // Status and timestamps
            $table->string('status')->default('pending');
            $table->string('tracking_number')->nullable();      // Added for tracking
            $table->json('tracking_history')->nullable();       // Added for tracking
            $table->timestamp('shipped_at')->nullable();        // Added for tracking
            $table->timestamp('delivered_at')->nullable();      // Added for tracking
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
