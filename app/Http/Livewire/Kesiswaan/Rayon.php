<?php

namespace App\Http\Livewire\Kesiswaan;

use Livewire\Component;
use App\Models\Rayon as RayonModel;

class Rayon extends Component
{
    public $namaRayon;
    public $jenisJkp;

    public function render()
    {
        $rayon = RayonModel::select('id', 'teacher_id', 'name')->with('teacher:id,name')->orderBy('name');
        $search = $this->namaRayon;

        if ($search != null) {
            $rayons = $rayon->where('name', 'like', "%{$search}%")->get();
        } else {
            $rayons = $rayon->get();
        }

        return view('livewire.kesiswaan.rayon', compact('rayons'));
    }
}
