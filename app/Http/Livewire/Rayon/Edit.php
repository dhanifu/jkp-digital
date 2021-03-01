<?php

namespace App\Http\Livewire\Rayon;

use App\Models\Pembimbing;
use App\Models\Rayon;
use Livewire\Component;

class Edit extends Component
{
    public $isOpen;
    public $rayon;

    protected $listeners = ['edit'];

    protected $rules = [
        'rayon.name' => 'required',
        'rayon.pembimbing_id' => 'required'
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
            'rayon.pembimbing_id' => 'required|exists:pembimbings,id'
        ]));

        $this->rayon->save();

        $this->reset('isOpen');
        $this->emit('refresh', 'Sukses Mengedit Rayon');
    }

    public function render(Pembimbing $pembimbing)
    {
        $pembimbings = $pembimbing->all();

        return view('livewire.rayon.edit', compact('pembimbings'));
    }
}
