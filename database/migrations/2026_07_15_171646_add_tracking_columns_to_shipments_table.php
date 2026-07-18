<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shipments', function (Blueprint $table) {

            $table->integer('estimated_days')->default(0);
            $table->integer('delay_days')->default(0);
            $table->date('actual_estimated_arrival')->nullable();
            $table->timestamp('last_monitoring')->nullable();
            $table->text('latest_information')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {

            $table->dropColumn([
                'estimated_days',
                'delay_days',
                'actual_estimated_arrival',
                'last_monitoring',
                'latest_information'
            ]);

        });
    }
};