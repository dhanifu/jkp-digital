<?php

namespace App\Http\Livewire\Kesiswaan\Pramuka;
use App\Models\Rayon;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $rayons = Rayon::all()->sortBy('name');
        return view('livewire.kesiswaan.pramuka.index', compact('rayons'));
    }
}
