<?php

namespace App\Http\Livewire\Major;

use App\Models\Major;
use App\Models\Rombel;
use App\Models\Student;
use Livewire\WithPagination;
use Livewire\Component;

class Data extends Component
{
    use WithPagination;

    public $search = null;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh', 'delete'];

    public function delete(Major $major)
    {
        $rombels = Rombel::where('major_id', $major->id);

        foreach ($rombels->get() as $value) {
            Student::where('rombel_id', $value->id)->delete();
        }

        $rombels->delete();
        $major->delete();

        $this->refresh('Sukses Menghapus Jurusan');
    }

    public function refresh(string $message)
    {
        $this->search = null;
        session()->flash('success', $message);
    }

    public function render()
    {
        $search = $this->search;

        $majors = Major::select('id', 'name')
            ->where('name', 'like', "%$search%")
            ->latest()->paginate(5);

        return view('livewire.major.data', compact('majors'));
    }
}
