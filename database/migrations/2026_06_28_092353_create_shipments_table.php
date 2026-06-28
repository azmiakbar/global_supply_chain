<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_id')
              ->constrained()
              ->onDelete('cascade');

            $table->unsignedBigInteger('origin_country_id');
            $table->unsignedBigInteger('destination_country_id');

            $table->unsignedBigInteger('origin_port_id');
            $table->unsignedBigInteger('destination_port_id');

            $table->integer('quantity');

            $table->string('transport_type');

            $table->date('departure_date');

            $table->date('estimated_arrival');

            $table->string('status');

            $table->string('risk_level');

            $table->integer('risk_score');

            $table->timestamps();

            $table->foreign('origin_country_id')
              ->references('id')
              ->on('countries');

            $table->foreign('destination_country_id')
              ->references('id')
              ->on('countries');

            $table->foreign('origin_port_id')
              ->references('id')
              ->on('ports');

            $table->foreign('destination_port_id')
              ->references('id')
              ->on('ports');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
