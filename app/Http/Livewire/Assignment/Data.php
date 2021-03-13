<?php

namespace App\Http\Livewire\Assignment;

use App\Models\Assignment;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh', 'delete', 'refreshData' => '$refresh'];

    public function delete(Assignment $assignment)
    {
        $assignment->delete();

        $this->refresh('Sukses Menghapus Jurusan');
    }

    public function refresh(string $message)
    {
        session()->flash('success', $message);
    }

    public function render(Assignment $assignment)
    {
        $assignments = $assignment->latest()->paginate(5);
        return view('livewire.assignment.data', compact('assignments'));
    }
}
