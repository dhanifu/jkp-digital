<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'pembimbing', 'student'];

        for ($i = 0; $i < count($roles); $i++) {
            Role::create([
                'name' => $roles[$i],
                'guard_name' => 'web',
            ]);
        }
    }
}
