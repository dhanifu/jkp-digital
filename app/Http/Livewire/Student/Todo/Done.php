<?php

namespace App\Http\Livewire\Student\Todo;

use App\Models\Jkp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Done extends Component
{
    public $perPage = 5;

    protected $listeners = [
        'refreshDone' => '$refresh',
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        $this->perPage += 8;
    }

    public function render()
    {
        $jkp_dones = Jkp::where('user_id', Auth::user()->id)
            ->with('assignment')->latest()->paginate($this->perPage);

        return view('livewire.student.todo.done', compact('jkp_dones'));
    }
}
