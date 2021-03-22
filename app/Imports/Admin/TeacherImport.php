<?php

namespace App\Imports\Admin;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TeacherImport implements ToCollection
{
    private $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::create([
                'email' => $row[0],
                'password' => '12345678',
            ]);
            $user->assignRole($this->role);

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'nip' => $row[1],
                'name' => $row[2],
                'agama' => $row[3],
                'gender' => $row[4],
            ]);

            $user->update(['pemilik_id' => $teacher->id]);
        }
    }
}
