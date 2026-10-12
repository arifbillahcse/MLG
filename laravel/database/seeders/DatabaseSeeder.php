<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Change this password immediately after the first login.
        User::updateOrCreate(
            ['email' => 'admin@mlg.com.bd'],
            ['name' => 'MLG Admin', 'password' => 'ChangeMe!2026', 'role' => 'admin'],
        );

        $this->call([
            SettingSeeder::class,
            CourseSeeder::class,
            DestinationSeeder::class,
            ScheduleSeeder::class,
            PeopleSeeder::class,
            ProofSeeder::class,
            BlogSeeder::class,
            ContentSeeder::class,
        ]);
    }
}
