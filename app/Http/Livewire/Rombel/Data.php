<?php

namespace App\Http\Livewire\Rombel;

use App\Models\Major;
use App\Models\Rombel;
use Livewire\WithPagination;
use Livewire\Component;

class Data extends Component
{
    use WithPagination;

    protected $listeners = ['refresh', 'delete'];
    protected $paginationTheme = 'bootstrap';

    public function delete(Rombel $rombel)
    {
        $rombel->delete();

        $this->refresh('Sukses Menghapus Rombel');
    }

    public function refresh(string $message)
    {
        session()->flash('success', $message);
    }

    public function render(Rombel $rombel)
    {
        $rombels = $rombel->select(['id', 'major_id', 'name'])
            ->latest()->paginate(5);

        return view('livewire.rombel.data', compact('rombels'));
    }
}
