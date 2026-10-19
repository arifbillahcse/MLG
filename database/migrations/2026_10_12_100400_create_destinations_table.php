<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();            // japan | korea | china
            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->string('flag', 16)->nullable();
            $table->text('intro')->nullable();
            $table->text('intro_bn')->nullable();
            $table->json('highlights')->nullable();      // the four card bullets
            $table->longText('universities')->nullable();
            $table->longText('application_process')->nullable();
            $table->longText('visa_guidance')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('destinations'); }
};
