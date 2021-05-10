<?php

namespace App\Http\Livewire\Rombel;

use App\Models\Major;
use App\Models\Rombel;
use Livewire\Component;

class Create extends Component
{
    public $name, $major_id;

    protected $rules = [
        'name' => 'required|string|unique:rombels',
        'major_id' => 'required|exists:majors,id'
    ];

    public function store(Rombel $rombel)
    {
        $data = $this->validate();

        $rombel->create($data);

        $this->emit('refresh', 'Sukses Menambah Rombel');
        $this->reset('name', 'major_id');
    }

    public function render(Major $major)
    {
        $majors = $major->select('id', 'name')->get();

        return view('livewire.rombel.create', compact('majors'));
    }
}
