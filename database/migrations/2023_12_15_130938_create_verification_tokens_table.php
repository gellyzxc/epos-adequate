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
        Schema::create('verification_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user')->constrained('users');
            $table->string('token')->unique();
            $table->boolean('revoked')->default(false);
            $table->enum('type', ['email', 'auth', 'class_add', 'teacher_school_add']);
            $table->foreignUuid('class')->nullable()->constrained('school_classes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_tokens');
    }
};
