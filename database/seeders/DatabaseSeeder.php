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
            MajorSeeder::class,
            AssignmentSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            TeacherSeeder::class,
            RayonSeeder::class,
            PembimbingSeeder::class,
            KesiswaanSeeder::class,
            RombelSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
