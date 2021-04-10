<?php

namespace Database\Seeders;

use App\Models\Rayon;
use App\Models\User;
use Illuminate\Database\Seeder;

class RayonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rayons = [
            'Ciawi 1', 'Ciawi 2', 'Ciawi 3', 'Ciawi 4', 'Ciawi 5',
            'Tajur 1', 'Tajur 2', 'Tajur 3', 'Tajur 4', 'Tajur 5',
            'Cisarua 1', 'Cisarua 2', 'Cisarua 3', 'Cisarua 4', 'Cisarua 5', 'Cisarua 6',
            'Cicurug 1', 'Cicurug 2', 'Cicurug 3', 'Cicurug 4', 'Cicurug 5', 'Cicurug 6', 'Cicurug 7',
            'Wikrama 1', 'Wikrama 2', 'Wikrama 3', 'Wikrama 4',
            'Sukasari 1', 'Sukasari 2',
        ];

        $pembimbings = User::with('teacher:id')->whereHas('roles', function ($q) {
            $q->where('name', 'pembimbing');
        })->each(function ($pembimbing, $i) use ($rayons) {
            Rayon::create([
                'name' => $rayons[$i],
                'teacher_id' => $pembimbing->teacher->id,
            ]);
        });

        // for ($i = 0; $i < count($rayons); $i++) {
        //     echo $rayons[$i];
        // }
    }
}
