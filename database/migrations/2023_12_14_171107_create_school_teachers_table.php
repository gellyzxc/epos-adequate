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
        Schema::create('school_teachers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('school')->constrained('schools');
            $table->foreignUuid('teacher')->constrained('users');
            $table->foreignUuid('leader')->nullable()->constrained('school_classes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_teachers');
    }
};
