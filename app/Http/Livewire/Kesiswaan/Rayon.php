<?php

namespace App\Http\Livewire\Kesiswaan;

use App\Models\Assignment;
use Livewire\Component;
use App\Models\Rayon as RayonModel;

class Rayon extends Component
{
    public $namaRayon;

    public function render()
    {
        $weeks = Assignment::select('id', 'minggu_ke')->latest()->get();
        $rayon = RayonModel::select('id', 'teacher_id', 'name')
            ->with('teacher:id,name', 'teacher.akun')->orderBy('name');

        $search = $this->namaRayon;

        if ($search != null) {
            $rayons = $rayon->where('name', 'like', "%{$search}%")->get();
        } else {
            $rayons = $rayon->get();
        }

        return view('livewire.kesiswaan.rayon', compact('rayons', 'weeks'));
    }
}
