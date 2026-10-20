<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_levels', function (Blueprint $table) {
            // The client quotes half months ("3.5 months"), which a smallint
            // silently truncated to 3.
            $table->decimal('months', 4, 1)->nullable()->change();

            // How the class actually runs — asked on every enquiry call.
            $table->unsignedTinyInteger('days_per_week')->nullable()->after('classes');
            $table->decimal('hours_per_day', 3, 1)->nullable()->after('days_per_week');

            // The pre-discount price, shown struck through beside the real one.
            // Null means no offer running, and the site shows one price.
            $table->unsignedInteger('fee_before')->nullable()->after('outcomes');
        });
    }

    public function down(): void
    {
        Schema::table('course_levels', function (Blueprint $table) {
            $table->dropColumn(['days_per_week', 'hours_per_day', 'fee_before']);
            $table->unsignedSmallInteger('months')->nullable()->change();
        });
    }
};
