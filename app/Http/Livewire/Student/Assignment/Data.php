<?php

namespace App\Http\Livewire\Student\Assignment;

use App\Models\Assignment;
use Livewire\Component;

class Data extends Component
{
    public function render()
    {
        $assignments = Assignment::select(['id', 'minggu_ke', 'from_date', 'to_date', 'created_at'])
            ->latest()->get();

        return view('livewire.student.assignment.data', compact('assignments'));
    }
}
