<?php

namespace App\Http\Livewire\Pembimbing\Students;

use App\Models\Assignment;
use Livewire\Component;

class Tab extends Component
{
    public function render()
    {
        $weeks = Assignment::select('id','minggu_ke')->latest()->get();

        return view('livewire.pembimbing.students.tab', compact('weeks'));
    }
}
