<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumlah = (int)$this->command->ask('Berapa banyak data user yang akan dibuat?', 10);
        $roleAsk = (int)$this->command->ask('(ROLE) 1. Pembimbing || 2. Kesiswaan || 1 atau 2 ?', 1);
        if ($roleAsk == 1) {
            $role = 'pembimbing';
        } elseif ($roleAsk == 2) {
            $role = 'kesiswaan';
        }

        $this->command->info("Membuat {$jumlah} {$role}.");

        $users = User::factory()->count($jumlah)->create();
        $users->each(function ($user) use ($jumlah, $role) {
            $user->assignRole($role);
            $pembimbings = Teacher::factory()->count($jumlah - $jumlah + 1)->create(['user_id' => $user->id]);
            $pembimbings->each(function ($pembimbing) {
                $u = User::find($pembimbing->user_id);
                $u->pemilik_id = $pembimbing->id;
                $u->save();
            });
        });

        $this->command->info('Berhasil dibuat!');
    }
}
