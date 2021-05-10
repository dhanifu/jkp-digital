<?php

namespace App\Http\Livewire\Rayon;

use App\Models\Rayon;
use App\Models\Student;
use Livewire\WithPagination;
use Livewire\Component;

class Data extends Component
{
    use WithPagination;

    public $search;
    protected $listeners = ['refresh', 'delete'];
    protected $paginationTheme = 'bootstrap';

    public function delete(Rayon $rayon)
    {
        Student::where('rayon_id', $rayon->id)->delete();
        $rayon->delete();

        $this->refresh('Sukses Menghapus Rayon');
    }

    public function refresh(string $message)
    {
        $this->search = '';
        session()->flash('success', $message);
    }

    public function render()
    {
        $search = $this->search;

        $rayons = Rayon::select('id', 'teacher_id', 'name')
            ->where('name', 'like', "%$search%")->latest()->paginate(5);

        return view('livewire.rayon.data', compact('rayons'));
    }
}
