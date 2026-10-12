<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Seminars and free mock tests — both are a dated thing people book.
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('seminar');  // seminar | mock_test
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('starts_at')->nullable();
            $table->string('venue')->nullable();
            $table->unsignedSmallInteger('seats')->nullable();
            $table->boolean('is_free')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['type', 'starts_at']);
        });
    }

    public function down(): void { Schema::dropIfExists('events'); }
};
