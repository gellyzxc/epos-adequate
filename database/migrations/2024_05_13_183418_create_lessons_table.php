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
            $table->id();
            $table->foreignId('class_day_timetable_id')->constrained('class_day_timetables');
            $table->integer('duration');
            $table->integer('number');
            $table->string('cabinet')->nullable();
            $table->foreignUuid('teacher_profile_id')->constrained('profile_teachers');
            $table->enum('type', ['local', 'distant', 'other']);
            $table->timestamps();
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
