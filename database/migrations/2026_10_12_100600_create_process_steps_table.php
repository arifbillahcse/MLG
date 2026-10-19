<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // The six-step application timeline. destination_id null = applies to all.
        Schema::create('process_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('step_label');                // "Step 1"
            $table->string('title');
            $table->string('title_bn')->nullable();
            $table->text('body')->nullable();
            $table->text('body_bn')->nullable();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('process_steps'); }
};
