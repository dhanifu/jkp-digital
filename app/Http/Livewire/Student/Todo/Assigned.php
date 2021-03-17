<?php

namespace App\Http\Livewire\Student\Todo;

use App\Models\Assignment;
use Livewire\Component;

class Assigned extends Component
{
    protected $listeners = ['refreshAssigned' => '$refresh'];

    public function render()
    {
        $assignments = Assignment::select(['id', 'minggu_ke', 'from_date', 'to_date', 'created_at'])
            ->latest()->get();
        return view('livewire.student.todo.assigned', compact('assignments'));
    }
}
