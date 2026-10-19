<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Covers all three Success Stories formats: video, written review,
        // alumni interview.
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('meta')->nullable();          // "TOPIK 4 · Kyung Hee · 2025"
            $table->text('quote')->nullable();
            $table->string('type')->default('written');  // written | video | alumni
            $table->string('video_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('thumb_variant', 8)->nullable();
            $table->unsignedTinyInteger('rating')->nullable();
            $table->boolean('consent_given')->default(false); // publish only with permission
            $table->boolean('is_featured')->default(false);
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('testimonials'); }
};
