<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('order_id')->constrained()->nullable();
            $table->integer('rating')->unsigned()->between(1, 5);
            $table->timestamps();

            $table->unique(['user_id', 'product_id', 'order_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ratings');
    }
};
