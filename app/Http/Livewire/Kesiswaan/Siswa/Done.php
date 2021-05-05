<?php

namespace App\Http\Livewire\Kesiswaan\Siswa;

use Livewire\Component;

class Done extends Component
{
    public $weeks;
    public $minggu_ke;
    public $perPage = 10;

    protected $listeners = [
        'refreshDone' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.kesiswaan.siswa.done');
    }
}
