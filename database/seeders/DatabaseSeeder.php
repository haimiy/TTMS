<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            ClassSeeder::class,
            DaySeeder::class,
            RoomSeeder::class,
            SlotSeeder::class,
            SubjectSeeder::class,
            TimetableSeeder::class,
            UserSeeder::class,
            DepartmentSeeder::class,
        ]);
    }
}
