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
        Schema::create('profile_teachers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('teacher')->constrained('users');
            $table->foreignUuid('subject')->constrained('school_subjects');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_teachers');
    }
};
