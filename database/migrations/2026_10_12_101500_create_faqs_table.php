<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // scope lets the homepage FAQ and the per-course FAQ share one table.
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('scope')->default('home');    // home | course | destination
            $table->foreignId('course_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('destination_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('question');
            $table->string('question_bn')->nullable();
            $table->text('answer');
            $table->text('answer_bn')->nullable();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['scope', 'sort']);
        });
    }

    public function down(): void { Schema::dropIfExists('faqs'); }
};
