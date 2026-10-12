<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Phone, address, hours, social links, map embed — everything the
        // topbar and footer hard-code today.
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general'); // general | contact | social | seo
            $table->string('label');
            $table->string('type')->default('text');     // text | textarea | url | email | tel
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('settings'); }
};
