<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assignment::create([
            'minggu_ke' => 30,
            'from_date' => '2021-03-15 00:00:00',
            'to_date' => '2021-03-20 23:59:59',
        ]);
    }
}
