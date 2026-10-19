<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // The marquee. is_verified exists so an unsubstantiated partner can be
        // stored but withheld from the public page.
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('destination_id')->nullable()->constrained()->nullOnDelete();
            $table->string('logo')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('partners'); }
};
