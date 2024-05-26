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
        Schema::create('school_class_teachers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('class')->constrained('school_classes');
            $table->foreignUuid('profile')->constrained('profile_teachers');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_class_teachers');
    }
};
