<?php

namespace Database\Seeders;

use App\Models\Pembimbing;
use App\Models\User;
use Illuminate\Database\Seeder;

class PembimbingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'pembimbing@jkp.com',
            'password' => '12345678',
        ]);
        $user->assignRole('pembimbing');

        $pembimbing = Pembimbing::create([
            'user_id' => $user->id,
            'nip' => 'PRW000000001',
            'name' => 'Pembimbing WK',
            'agama' => 'Islam',
            'gender' => 'L',
        ]);

        $user->update([
            'pemilik_id' => $pembimbing->id
        ]);
    }
}
