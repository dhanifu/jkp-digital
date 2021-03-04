<?php

namespace App\Http\Livewire\Student;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    protected $listeners = ['refresh', 'delete'];
    protected $paginationTheme = 'bootstrap';

    public function delete(Student $student)
    {
        $student->delete();

        $this->refresh('Sukses Menghapus Siswa');
    }

    public function refresh(string $message)
    {
        session()->flash('success', $message);
    }

    public function render(Student $student)
    {
        $students = $student->latest()->paginate(5);
        return view('livewire.student.data', compact('students'));
    }
}
