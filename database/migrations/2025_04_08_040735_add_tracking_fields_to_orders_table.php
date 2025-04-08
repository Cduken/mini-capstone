<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackingFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('tracking_number')->nullable()->after('status');
            $table->json('tracking_history')->nullable()->after('tracking_number');
            $table->timestamp('shipped_at')->nullable()->after('tracking_history');
            $table->timestamp('delivered_at')->nullable()->after('shipped_at');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['tracking_number', 'tracking_history', 'shipped_at', 'delivered_at']);
        });
    }
}
