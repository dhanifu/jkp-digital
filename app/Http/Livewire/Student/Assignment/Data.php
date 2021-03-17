<?php

namespace App\Http\Livewire\Student\Assignment;

use App\Models\Assignment;
use Livewire\Component;

class Data extends Component
{
    public $perPage = 6;
    protected $listeners = [
        'load-more' => 'loadMore',
    ];

    public function default()
    {
        $this->perPage = 8;
    }

    public function loadMore()
    {
        $this->perPage += 6;
    }

    public function render()
    {
        $assignments = Assignment::select(['id', 'minggu_ke', 'from_date', 'to_date', 'created_at'])
            ->latest()->paginate($this->perPage);

        return view('livewire.student.assignment.data', compact('assignments'));
    }
}
