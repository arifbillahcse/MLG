<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Every one of the eight forms lands here. Today they all post nowhere;
        // Phase 5 points them at this table.
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('interest')->nullable();
            $table->text('message')->nullable();
            $table->string('source_form')->nullable();   // leadForm | mockForm | japaneseEnrol …
            $table->string('source_page')->nullable();
            $table->string('status')->default('new');    // new | contacted | enrolled | closed
            $table->text('admin_note')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->ipAddress('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('contacted_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void { Schema::dropIfExists('enquiries'); }
};
