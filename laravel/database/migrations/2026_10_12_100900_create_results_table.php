<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // The top-scores board. score is a string because it holds 8.0, N4,
        // TOPIK 4 and HSK 3 alike.
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('exam');                      // IELTS | JLPT | TOPIK | HSK | NAT
            $table->string('score');
            $table->string('student_name');
            $table->string('meta')->nullable();          // "First attempt · 2025"
            $table->foreignId('course_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('consent_given')->default(false);
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('results'); }
};
