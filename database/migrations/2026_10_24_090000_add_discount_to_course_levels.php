<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The admin now enters a regular price and a discount amount; the final
     * price is derived, never typed. Storing the discount rather than the
     * final figure means the two can never drift apart.
     *
     * fee_before holds the regular price and fee_in_class the computed final
     * one, so every existing reader keeps working unchanged.
     */
    public function up(): void
    {
        Schema::table('course_levels', function (Blueprint $table) {
            $table->unsignedInteger('discount')->default(0)->after('fee_before');
        });

        // Backfill without assuming a MySQL-only function, and without
        // touching rows that have no fee at all.
        foreach (DB::table('course_levels')->select('id', 'fee_before', 'fee_in_class')->cursor() as $row) {
            $regular = $row->fee_before ?? $row->fee_in_class;

            if ($regular === null) {
                continue;
            }

            $discount = max(0, $regular - ($row->fee_in_class ?? $regular));

            DB::table('course_levels')->where('id', $row->id)->update([
                'fee_before' => $regular,
                'discount' => $discount,
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('course_levels', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
};
