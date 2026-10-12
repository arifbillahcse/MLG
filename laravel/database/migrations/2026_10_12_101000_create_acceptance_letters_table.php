<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acceptance_letters', function (Blueprint $table) {
            $table->id();
            $table->string('university');
            $table->foreignId('destination_id')->nullable()->constrained()->nullOnDelete();
            $table->string('intake')->nullable();        // "April 2025 intake"
            $table->string('image')->nullable();         // redacted scan
            $table->boolean('consent_given')->default(false);
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('acceptance_letters'); }
};
