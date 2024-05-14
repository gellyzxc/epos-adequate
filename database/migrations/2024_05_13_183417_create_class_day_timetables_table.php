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
        Schema::create('class_day_timetables', function (Blueprint $table) {
            $table->id();
            $table->enum('day', ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']);
            $table->foreignId('timetable_id')->constrained('timetable');
            $table->foreignUuid('class')->constrained('school_classes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_day_timetables');
    }
};
