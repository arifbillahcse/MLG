<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * The Japanese course listed three instructors I invented while the real
     * staff were unknown. The client has named one real teacher, so the
     * placeholders have to go — a language school listing teachers who do not
     * exist is worse than listing none.
     *
     * Named explicitly rather than "delete everything the seeder no longer
     * lists", so a person the client added through the admin is never caught
     * by this.
     */
    public function up(): void
    {
        DB::table('faculty')
            ->whereIn('name', ['Shahriar Rahman', 'Mahfuza Khatun', 'Yuki Tanaka'])
            ->delete();
    }

    public function down(): void
    {
        // Nothing to restore: these were invented names, not lost data.
    }
};
