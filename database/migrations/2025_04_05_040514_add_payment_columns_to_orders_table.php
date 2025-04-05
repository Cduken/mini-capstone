<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Only add columns if they don't exist
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')
                    ->after('shipping_method')
                    ->default('unknown');
            }

            if (!Schema::hasColumn('orders', 'payment_details')) {
                $table->json('payment_details')
                    ->nullable()
                    ->after('payment_method');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Safely drop columns if they exist
            if (Schema::hasColumn('orders', 'payment_method')) {
                $table->dropColumn('payment_method');
            }

            if (Schema::hasColumn('orders', 'payment_details')) {
                $table->dropColumn('payment_details');
            }
        });
    }
};
