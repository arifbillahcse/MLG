<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // N5, N4, TOPIK I/II, HSK 1-2/3, IELTS Academic/General.
        Schema::create('course_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('code');                      // N5
            $table->string('label');                     // Beginner
            $table->string('subtitle')->nullable();
            $table->unsignedSmallInteger('months')->nullable();
            $table->unsignedSmallInteger('classes')->nullable();
            $table->string('vocabulary')->nullable();    // "~800"
            $table->string('characters')->nullable();    // "~100" kanji / hanzi
            $table->json('outcomes')->nullable();        // bullet list
            $table->unsignedInteger('fee_in_class')->nullable();
            $table->unsignedInteger('fee_online')->nullable();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('course_levels'); }
};
