<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Only add columns if they don't exist
            if (!Schema::hasColumn('orders', 'address_line_1')) {
                $table->text('address_line_1')->nullable();
            }

            if (!Schema::hasColumn('orders', 'address_line_2')) {
                $table->text('address_line_2')->nullable();
            }

            if (!Schema::hasColumn('orders', 'region')) {
                $table->string('region')->nullable();
            }

            if (!Schema::hasColumn('orders', 'region_code')) {
                $table->string('region_code', 10)->nullable();
            }

            if (!Schema::hasColumn('orders', 'province')) {
                $table->string('province')->nullable();
            }

            if (!Schema::hasColumn('orders', 'province_code')) {
                $table->string('province_code', 10)->nullable();
            }

            if (!Schema::hasColumn('orders', 'city_code')) {
                $table->string('city_code', 10)->nullable();
            }

            if (!Schema::hasColumn('orders', 'barangay')) {
                $table->string('barangay')->nullable();
            }

            if (!Schema::hasColumn('orders', 'barangay_code')) {
                $table->string('barangay_code', 10)->nullable();
            }

            // Update existing records with default values
            if (Schema::hasColumn('orders', 'address_line_1')) {
                DB::table('orders')
                    ->whereNull('address_line_1')
                    ->update([
                        'address_line_1' => 'Address not migrated',
                        'region' => 'Unknown',
                        'region_code' => '00',
                        'province' => 'Unknown',
                        'province_code' => '00',
                        'city_code' => '00',
                        'barangay' => 'Unknown',
                        'barangay_code' => '00'
                    ]);
            }

            // Change columns to non-nullable if they exist
            if (Schema::hasColumn('orders', 'address_line_1')) {
                $table->text('address_line_1')->nullable(false)->change();
            }
            if (Schema::hasColumn('orders', 'region')) {
                $table->string('region')->nullable(false)->change();
            }
            if (Schema::hasColumn('orders', 'region_code')) {
                $table->string('region_code', 10)->nullable(false)->change();
            }
            if (Schema::hasColumn('orders', 'province')) {
                $table->string('province')->nullable(false)->change();
            }
            if (Schema::hasColumn('orders', 'province_code')) {
                $table->string('province_code', 10)->nullable(false)->change();
            }
            if (Schema::hasColumn('orders', 'city_code')) {
                $table->string('city_code', 10)->nullable(false)->change();
            }
            if (Schema::hasColumn('orders', 'barangay')) {
                $table->string('barangay')->nullable(false)->change();
            }
            if (Schema::hasColumn('orders', 'barangay_code')) {
                $table->string('barangay_code', 10)->nullable(false)->change();
            }
        });
    }

    public function down()
    {
        // Don't drop columns in down() to prevent data loss
    }
};
