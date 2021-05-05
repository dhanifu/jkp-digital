<?php

namespace App\Http\Livewire\Kesiswaan\Siswa;

use Livewire\Component;

class Missing extends Component
{
    public $weeks;
    public $minggu_ke;
    public $perPage = 10;

    protected $listeners = [
        'refreshMissing' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.kesiswaan.siswa.missing');
    }
}
