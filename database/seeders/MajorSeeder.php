<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = [
            'Rekayasa Perangkat Lunak',
            'Teknik Komputer dan Jaringan',
            'Multimedia',
            'Bisnis Daring dan Pemasaran',
            'Otomatisasi Tata Kelola Perkantoran',
            'Tataboga',
            'Perhotelan',
        ];

        for ($i = 0; $i < count($jurusan); $i++) {
            Major::create([
                'name' => $jurusan[$i],
            ]);
        }
    }
}
