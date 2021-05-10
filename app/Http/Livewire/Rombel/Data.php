<?php

namespace App\Http\Livewire\Rombel;

use App\Models\Rombel;
use App\Models\Student;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class Data extends Component
{
    use WithPagination;

    public $search = null;

    protected $listeners = ['refresh', 'delete'];
    protected $paginationTheme = 'bootstrap';

    public function delete(Rombel $rombel)
    {
        $students = Student::where('rombel_id', $rombel->id);

        foreach ($students->get() as $value) {
            User::find($value->user_id)->delete();
        }

        $students->delete();
        $rombel->delete();

        $this->refresh('Sukses Menghapus Rombel');
    }

    public function refresh(string $message)
    {
        $this->reset('search');
        session()->flash('success', $message);
    }

    public function render(Rombel $rombel)
    {
        $search = $this->search;

        $rombels = $rombel->select(['id', 'major_id', 'name'])
            ->where('name', 'like', "%$search%")
            ->orWhereHas('major', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })->latest()->paginate(5);

        return view('livewire.rombel.data', compact('rombels'));
    }
}
