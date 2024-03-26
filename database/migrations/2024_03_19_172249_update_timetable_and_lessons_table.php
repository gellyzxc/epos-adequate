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
        Schema::table('timetable', function (Blueprint $table) {
            // $table->foreignUuid('lesson')->constrained('lessons');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('day');
            $table->dropColumn('week');
            $table->dropColumn('year');
            $table->dropColumn('class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
