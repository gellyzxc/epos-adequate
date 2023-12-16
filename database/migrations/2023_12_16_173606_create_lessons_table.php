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
        Schema::create('lessons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('teacher')->constrained('users');
            $table->foreignUuid('subject')->constrained('school_subjects');
            $table->foreignUuid('class')->constrained('school_classes');
            $table->string('day');
            $table->integer('number');
            $table->enum('type', ['local', 'distant', 'other']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
