<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_analyses', function (Blueprint $table) {
            $table->id();

            $table->string('country')->nullable();
            $table->string('source')->nullable();

            $table->string('title');
            $table->text('description')->nullable();

            $table->string('url')->unique();

            $table->dateTime('published_at')->nullable();

            $table->enum('sentiment', [
                'Positif',
                'Netral',
                'Negatif'
            ])->default('Netral');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_analyses');
    }
};