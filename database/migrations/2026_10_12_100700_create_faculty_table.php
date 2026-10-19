<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // The About page splits these into instructors and counsellors,
        // which is the `group` column.
        Schema::create('faculty', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('initials', 4)->nullable();   // avatar fallback
            $table->string('role');                      // "Japanese · JLPT"
            $table->string('credential')->nullable();
            $table->text('quote')->nullable();           // teaching philosophy
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('avatar_variant', 8)->nullable(); // '', 'r', 't'
            $table->string('group')->default('instructor');  // instructor | counsellor
            $table->foreignId('course_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('faculty'); }
};
