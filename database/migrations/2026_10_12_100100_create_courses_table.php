<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Japanese, Korean, Chinese, IELTS. Phase 6 serves /courses/{slug}
        // from here, which is why korean.html and chinese.html never get built.
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->string('native_name')->nullable();   // 日本語 / 한국어 / 中文
            $table->string('glyph', 16)->nullable();     // あ / 한 / 中 / IELTS
            $table->string('exam_name')->nullable();     // JLPT / TOPIK / HSK
            $table->text('description')->nullable();
            $table->text('description_bn')->nullable();
            $table->boolean('is_test_prep')->default(false); // true -> teal rail
            $table->boolean('offers_online')->default(true);
            $table->boolean('offers_in_class')->default(true);
            $table->unsignedInteger('price_from')->nullable();   // BDT, whole taka
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('courses'); }
};
