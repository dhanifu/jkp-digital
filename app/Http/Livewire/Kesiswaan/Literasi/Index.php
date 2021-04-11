<?php

namespace App\Http\Livewire\Kesiswaan\Literasi;
use App\Models\Rayon;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $rayons = Rayon::all()->sortBy('name');
        return view('livewire.kesiswaan.literasi.index', compact('rayons'));
    }
}
