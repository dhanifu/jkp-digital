<?php

namespace App\Http\Livewire\Kesiswaan\Keagamaan;
use App\Models\Rayon;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $rayons = Rayon::all()->sortBy('name');
        return view('livewire.kesiswaan.keagamaan.index', compact('rayons'));
    }
}
