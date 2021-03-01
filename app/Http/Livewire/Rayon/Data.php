<?php

namespace App\Http\Livewire\Rayon;

use App\Models\Rayon;
use Livewire\WithPagination;
use Livewire\Component;

class Data extends Component
{
    use WithPagination;

    protected $listeners = ['refresh', 'delete'];

    public function delete(Rayon $rayon)
    {
        $rayon->delete();

        $this->refresh('Sukses Menghapus Rayon');
    }

    public function refresh(string $message)
    {
        session()->flash('success', $message);
    }

    public function render(Rayon $rayon)
    {
        //get Data with paginate
        $rayons = $rayon->paginate(5);


        return view('livewire.rayon.data', compact('rayons'));
    }
}
