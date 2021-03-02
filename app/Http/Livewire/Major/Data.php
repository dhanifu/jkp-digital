<?php

namespace App\Http\Livewire\Major;
use App\Models\Major;
use Livewire\WithPagination;
use Livewire\Component;

class Data extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh', 'delete'];

    public function delete(Major $major)
    {
        $major->delete();

        $this->refresh('Sukses Menghapus Jurusan');
    }

    public function refresh(string $message)
    {
        session()->flash('success', $message);
    }

    public function render(Major $major)
    {
        $majors = $major->latest()->paginate(5);
        return view('livewire.major.data', compact('majors'));
    }
}
