<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Rayon;
use App\Models\Rombel;
use Illuminate\Database\Seeder;

class RombelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $majors = Major::select('id', 'name')->get();

        $rpl = [
            'RPL X-1', 'RPL X-2', 'RPL X-3', 'RPL X-4',
            'RPL XI-1', 'RPL XI-2', 'RPL XI-3', 'RPL XI-4',
            'RPL XII-1', 'RPL XII-2', 'RPL XII-3', 'RPL XII-4',
        ];
        $tkj = [
            'TKJ X-1', 'TKJ X-2', 'TKJ X-3', 'TKJ X-4',
            'TKJ XI-1', 'TKJ XI-2', 'TKJ XI-3', 'TKJ XI-4',
            'TKJ XII-1', 'TKJ XII-2', 'TKJ XII-3', 'TKJ XII-4',
        ];
        $mmd = [
            'MMD X-1', 'MMD X-2',
            'MMD XI-1', 'MMD XI-2',
            'MMD XII-1', 'MMD XII-2',
        ];
        $bdp = [
            'BDP X-1', 'BDP X-2',
            'BDP XI-1', 'BDP XI-2',
            'BDP XII-1', 'BDP XII-2',
        ];
        $otkp = [
            'OTKP X-1', 'OTKP X-2',
            'OTKP XI-1', 'OTKP XI-2',
            'OTKP XII-1', 'OTKP XII-2',
        ];
        $tbg = [
            'TBG X-1', 'TBG X-2',
            'TBG XI-1', 'TBG XI-2',
            'TBG XII-1', 'TBG XII-2',
        ];
        $htl = [
            'HTL X-1', 'HTL X-2',
            'HTL XI-1', 'HTL XI-2',
            'HTL XII-1', 'HTL XII-2',
        ];

        

        foreach ($majors as $key => $value) {
            if ($value->name == "Rekayasa Perangkat Lunak") {
                foreach ($rpl as $rpl) {
                    Rombel::create([
                        "major_id" => $value->id,
                        "name" => $rpl,
                    ]);
                }
            }

            if ($value->name == "Teknik Komputer dan Jaringan") {
                foreach ($tkj as $tkj) {
                    Rombel::create([
                        "major_id" => $value->id,
                        "name" => $tkj,
                    ]);
                }
            }

            if ($value->name == "Multimedia") {
                foreach ($mmd as $mmd) {
                    Rombel::create([
                        "major_id" => $value->id,
                        "name" => $mmd,
                    ]);
                }
            }

            if ($value->name == "Bisnis Daring dan Pemasaran") {
                foreach ($bdp as $bdp) {
                    Rombel::create([
                        "major_id" => $value->id,
                        "name" => $bdp,
                    ]);
                }
            }

            if ($value->name == "Otomatisasi Tata Kelola Perkantoran") {
                foreach ($otkp as $otkp) {
                    Rombel::create([
                        "major_id" => $value->id,
                        "name" => $otkp,
                    ]);
                }
            }

            if ($value->name == "Tataboga") {
                foreach ($tbg as $tbg) {
                    Rombel::create([
                        "major_id" => $value->id,
                        "name" => $tbg,
                    ]);
                }
            }

            if ($value->name == "Perhotelan") {
                foreach ($htl as $htl) {
                    Rombel::create([
                        "major_id" => $value->id,
                        "name" => $htl,
                    ]);
                }
            }
        }
    }
}
