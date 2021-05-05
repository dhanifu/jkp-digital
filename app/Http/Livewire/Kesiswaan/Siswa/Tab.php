<?php

namespace App\Http\Livewire\Kesiswaan\Siswa;

use App\Models\Assignment;
use Livewire\Component;

class Tab extends Component
{
    public function render()
    {
        $weeks = Assignment::select('id', 'minggu_ke')->latest()->get();

        return view('livewire.kesiswaan.siswa.tab', compact('weeks'));
    }
}
