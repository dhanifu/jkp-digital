<?php

namespace App\Imports\Admin;

use App\Models\Pembimbing;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PembimbingImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::create([
                'email' => $row[0],
                'password' => '12345678',
            ]);
            $user->assignRole('pembimbing');

            $pembimbing = Pembimbing::create([
                'user_id' => $user->id,
                'nip' => $row[1],
                'name' => $row[2],
                'agama' => $row[3],
                'gender' => $row[4],
            ]);

            $user->update(['pemilik_id' => $pembimbing->id]);
        }
    }
}
