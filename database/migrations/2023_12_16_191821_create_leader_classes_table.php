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
        Schema::create('leader_classes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('class')->constrained('school_classes');
            $table->foreignUuid('teacher')->constrained('school_teachers');
            $table->timestamps();
        });

        Schema::table('school_teachers', function (Blueprint $table) {
            $table->dropColumn('leader');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leader_classes');

        Schema::table('school_teachers', function (Blueprint $table) {
            $table->string('leader')->nullable();
        });
    }
};
