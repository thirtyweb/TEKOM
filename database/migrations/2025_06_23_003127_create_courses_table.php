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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique(); // IPB110A, KIM1104, etc
            $table->string('name'); // Nama mata kuliah
            $table->string('sks', 10); // Format: 3(2-1) atau 2(2-0)
            $table->string('prerequisite')->nullable(); // Mata kuliah prasyarat
            $table->integer('semester'); // Semester 1-8
            $table->string('category'); // Kategori mata kuliah
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
