<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // The homepage countdown reads starts_at from here. A date that has
        // passed stops rendering instead of sitting there like Ichiban's 2017
        // seminar — that is the whole point of this table.
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_level_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');                     // Morning Batch
            $table->string('tag')->nullable();           // "Japanese N5 · In class"
            $table->string('mode')->default('in_class'); // in_class | online
            $table->string('days')->nullable();          // "Sat · Mon · Wed"
            $table->string('time_label')->nullable();    // "10:00 AM"
            $table->string('duration_label')->nullable();// "4 months"
            $table->dateTime('starts_at')->nullable();   // null = rolling enrolment
            $table->unsignedSmallInteger('seats_total')->default(20);
            $table->unsignedSmallInteger('seats_left')->default(20);
            $table->boolean('is_featured')->default(false); // drives the countdown
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('batches'); }
};
