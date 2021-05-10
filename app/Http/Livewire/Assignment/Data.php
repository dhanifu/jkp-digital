<?php

namespace App\Http\Livewire\Assignment;

use App\Models\Assignment;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $search = null;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh', 'delete', 'refreshData' => '$refresh'];

    public function delete(Assignment $assignment)
    {
        $assignment->delete();

        $this->refresh('Sukses Menghapus Assignment');
    }

    public function refresh(string $message)
    {
        $this->reset('search');
        session()->flash('success', $message);
    }

    public function render(Assignment $assignment)
    {
        $search = $this->search;

        $assignments = $assignment->where('minggu_ke', 'like', "%$search%")->latest()->paginate(5);

        return view('livewire.assignment.data', compact('assignments'));
    }
}
