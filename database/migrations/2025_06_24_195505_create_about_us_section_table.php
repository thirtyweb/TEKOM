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
        Schema::create('about_us_section', function (Blueprint $table) {
            $table->id();
            $table->text('about_us_description')->nullable();
            $table->text('vision_text')->nullable();
            $table->json('mission_items')->nullable();
            $table->json('facts')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_section');
    }
};
