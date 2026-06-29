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
        Schema::create('news_caches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('country_id')
              ->constrained()
              ->onDelete('cascade');

            $table->string('title');
            $table->string('source');
            $table->text('content')->nullable();
            $table->string('sentiment');
            $table->dateTime('published_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_caches');
    }
};
