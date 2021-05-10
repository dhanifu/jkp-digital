<?php

namespace App\Http\Livewire\Major;

use App\Models\Major;
use Livewire\Component;

class Edit extends Component
{

    public $isOpen;
    public $major;

    protected $listeners = ['edit'];

    protected $rules = [
        'major.name' => 'required',
    ];

    public function edit(Major $major)
    {
        $this->isOpen = true;
        $this->major = $major;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'major.name' => 'required|string|unique:majors,name,' . $this->major->name,
        ]));

        $this->major->save();

        $this->emit('refresh', 'Sukses Mengedit Jurusan');
        $this->reset('isOpen');
    }

    public function render(Major $major)
    {
        $majors = $major->all();
        return view('livewire.major.edit', compact('majors'));
    }
}
