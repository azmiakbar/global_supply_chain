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
        Schema::create('risk_scores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('country_id')
              ->constrained()
              ->onDelete('cascade');

            $table->integer('weather_score');
            $table->integer('port_score');
            $table->integer('currency_score');
            $table->integer('inflation_score');
            $table->integer('news_score');
            $table->integer('total_score');
            $table->string('risk_level');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_scores');
    }
};
