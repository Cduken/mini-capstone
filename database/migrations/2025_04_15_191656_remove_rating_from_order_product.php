<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            if (Schema::hasColumn('order_product', 'rating')) {
                $table->dropColumn('rating');
            }
        });
    }

    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->integer('rating')->nullable();
        });
    }
};
