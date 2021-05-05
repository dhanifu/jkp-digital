<?php

namespace App\Http\Livewire\Student\Setting;

use Livewire\Component;

class Account extends Component
{
    public $user;

    protected $listeners = [
        'refreshAccount' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.student.setting.account');
    }
}
