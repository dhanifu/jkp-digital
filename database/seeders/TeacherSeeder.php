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
        $roleAsk = (int)$this->command->ask("(ROLE)\n 1. Pembimbing\n 2. Kesiswaan\n Default = Pembimbing", 1);

        if ($roleAsk == 1) {
            $role = 'pembimbing';
            $jumlah = 29;
        } elseif ($roleAsk == 2) {
            $role = 'kesiswaan';
            $jumlah = (int)$this->command->ask("Berapa banyak data kesiswaan yang akan dibuat? default=10", 10);
        } else {
            $this->command->info("Memilih selain 1 dan 2 = Memilih Pembimbing.");
            $role = "pembimbing";
            $jumlah = 29;
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
