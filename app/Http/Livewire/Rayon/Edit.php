<?php

namespace App\Http\Livewire\Rayon;

use App\Models\Teacher;
use App\Models\Rayon;
use Livewire\Component;

class Edit extends Component
{
    public $isOpen;
    public $rayon;

    protected $listeners = ['edit'];

    protected $rules = [
        'rayon.name' => 'required',
        'rayon.teacher_id' => 'required'
    ];

    public function edit(Rayon $rayon)
    {
        $this->isOpen = true;
        $this->rayon = $rayon;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'rayon.name' => 'required|string|unique:rayons,name,' . $this->rayon->id,
            'rayon.teacher_id' => 'required|exists:teachers,id'
        ]));

        $this->rayon->save();

        $this->reset('isOpen');
        $this->emit('refresh', 'Sukses Mengedit Rayon');
    }

    public function render(Teacher $teacher)
    {
        $roles = \Spatie\Permission\Models\Role::all();
        $users = \App\Models\User::with('roles', 'teacher')->get();
        $pembimbings = $users->reject(function ($user, $key) {
            return $user->hasRole(['kesiswaan', 'admin']);
        });

        return view('livewire.rayon.edit', compact('pembimbings'));
    }
}
