<?php

namespace App\Http\Livewire\Rombel;

use App\Models\Major;
use App\Models\Rombel;
use Livewire\Component;

class Edit extends Component
{
    public $isOpen, $rombel;

    protected $listeners = ['edit'];

    protected $rules = [
        'rombel.name' => 'required',
        'rombel.major_id' => 'required'
    ];

    public function edit(Rombel $rombel)
    {
        $this->isOpen = true;
        $this->rombel = $rombel;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'rombel.name' => 'required|string|unique:rombels,name,' . $this->rombel->id,
            'rombel.major_id' => 'required|exists:majors,id'
        ]));

        $this->rombel->save();

        $this->emit('refresh', 'Sukses Mengedit Rombel');
        $this->reset('isOpen');
    }
    public function render(Major $major)
    {
        $majors = $major->select(['id', 'name'])
            ->with('rombel:id,name,major_id')->get();

        return view('livewire.rombel.edit', compact('majors'));
    }
}
