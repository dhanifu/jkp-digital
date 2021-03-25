<?php

namespace App\Http\Livewire\Rayon;

use App\Models\Teacher;
use App\Models\Rayon;

use Livewire\Component;

class Create extends Component
{
    public $name, $teacher_id;

    protected $rules = [
        'name' => 'required|string|unique:rayons',
        'teacher_id' => 'required'
    ];

    public function store(Rayon $rayon)
    {
        $data = $this->validate();

        $rayon->create($data);

        $this->emit('refresh', 'Sukses Menambah Rayon');
        $this->reset('name', 'teacher_id');
    }


    public function render(Teacher $teacher)
    {
        $roles = \Spatie\Permission\Models\Role::all();
        $users = \App\Models\User::with('roles', 'teacher')->get();
        $teachers = $users->reject(function ($user, $key) {
            return $user->hasRole(['kesiswaan', 'admin', 'student']);
        });
        return view('livewire.rayon.create', compact('teachers'));
    }
}
