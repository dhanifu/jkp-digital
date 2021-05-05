<?php

namespace App\Http\Livewire\Kesiswaan\Student;

use App\Models\Assignment;
use Livewire\Component;

class Tab extends Component
{
    public $rayon_id;

    public function render()
    {
        $weeks = Assignment::select('id', 'minggu_ke')->latest()->get();

        return view('livewire.kesiswaan.student.tab', compact('weeks'));
    }
}
