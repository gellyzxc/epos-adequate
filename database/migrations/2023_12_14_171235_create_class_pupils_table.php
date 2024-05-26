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
        Schema::create('class_pupils', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('school_class')->constrained('school_classes');
            $table->foreignUuid('user')->constrained('pupil_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_pupils');
    }
};
