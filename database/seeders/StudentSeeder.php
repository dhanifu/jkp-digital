<?php

namespace Database\Seeders;

use App\Models\Rayon;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumlah = (int)$this->command->ask('Berapa banyak data siswa yang akan dibuat?', 10);

        $this->command->info("Membuat {$jumlah} siswa.");

        $users = User::factory()->count($jumlah)->create();
        $users->each(function ($user) use ($jumlah) {
            $user->assignRole('student');
            $students = Student::factory()->count($jumlah - $jumlah + 1)->create(['user_id' => $user->id]);
            $students->each(function ($student) {
                $u = User::find($student->user_id);
                $u->pemilik_id = $student->id;
                $u->save();

                $rayon = Rayon::select('id')->get();
                $rayon_id = $rayon[rand(0, count($rayon) - 1)]->id;

                $student->rayon_id = $rayon_id;
                $student->save();
            });
        });

        $this->command->info('Berhasil dibuat!');
    }
}
