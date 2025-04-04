<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity')->unsigned();
            $table->decimal('price', 10, 2);
            $table->timestamps();

            // Optional: Add unique constraint to prevent duplicate entries
            $table->primary(['order_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
    }
};
