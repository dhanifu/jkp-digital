<?php

namespace App\Imports\Admin;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        //dd($rows);
        foreach ($rows as $row) {
            $user = User::create([
                'email' => $row[0],
                'password' => '12345678',
            ]);
            $user->assignRole('student');
            
            $student = Student::create([
                'user_id' => $user->id,
                'nis' => (string)$row[1],
                'name' => $row[2],
                'kelas'=> (string)$row[3],
                'agama' => $row[4],
                'gender' => $row[5],
            ]);

            $user->update(['pemilik_id' => $student->id]);
        }
    }
}
