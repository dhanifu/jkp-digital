<?php

namespace App\Http\Livewire\Major;

use App\Models\Major;
use Livewire\Component;

class Create extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required',
    ];

    public function store(Major $major)
    {
        $data = $this->validate();

        $major->create($data);

        $this->emit('refresh', 'Sukses Menambah Jurusan');
        $this->reset('name');
    }

    public function render()
    {
        return view('livewire.major.create');
    }
}
