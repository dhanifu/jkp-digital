<?php

namespace App\Http\Livewire\Student\Todo;

use App\Models\Assignment;
use App\Models\Jkp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Assigned extends Component
{
    public $perPage = 8;

    protected $listeners = [
        'refreshAssigned' => '$refresh',
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        $this->perPage += 8;
    }

    public function render()
    {
        $assignments = Assignment::select(['id', 'minggu_ke', 'from_date', 'to_date', 'created_at'])
            ->latest()->paginate($this->perPage);
        return view('livewire.student.todo.assigned', compact('assignments'));
    }
}
