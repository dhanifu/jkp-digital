<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class KesiswaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'kesiswaan@jkp.com',
            'password' => '12345678',
        ]);
        $user->assignRole('kesiswaan');

        $kesiswaan = Teacher::create([
            'user_id' => $user->id,
            'nip' => 'PRW000000002',
            'name' => 'Kesiswaan WK',
            'agama' => 'Islam',
            'gender' => 'L',
        ]);

        $user->update([
            'pemilik_id' => $kesiswaan->id
        ]);
    }
}
