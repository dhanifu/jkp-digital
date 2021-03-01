<?php

namespace App\Http\Livewire\Rayon;

use App\Models\Pembimbing;
use App\Models\Rayon;

use Livewire\Component;

class Create extends Component
{
    public $name, $pembimbing_id;

    protected $rules = [
        'name' => 'required|string|unique:rayons',
        'pembimbing_id' => 'required'
    ];

    public function store(Rayon $rayon)
    {
        $data = $this->validate();
        
        $rayon->create($data);

        $this->emit('refresh', 'Sukses Menambah Rayon');
        $this->reset('name', 'pembimbing_id');
    }


    public function render(Pembimbing $pembimbing)
    {
        $pembimbings = $pembimbing->all();
        return view('livewire.rayon.create', compact('pembimbings'));
    }
}
