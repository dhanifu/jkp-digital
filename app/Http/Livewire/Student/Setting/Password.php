<?php

namespace App\Http\Livewire\Student\Setting;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Password extends Component
{
    public $user;

    protected $listeners = [
        'refreshPassword' => '$refresh',
        'alert'
    ];

    public function update()
    {
        // 
    }

    public function render()
    {
        return view('livewire.student.setting.password');
    }
}
