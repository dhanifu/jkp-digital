<?php

namespace App\Http\Livewire\Student\Setting;

use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $user;
    public $assignment;

    public function __construct()
    {
        $this->user = Student::where('user_id', Auth::user()->id)
            ->with([
                'akun:id,email,password',
                'rombel:id,name',
                'rayon:id,name'
            ])->first();

        $this->assignment = Assignment::select('id', 'minggu_ke')->latest()->first();
    }

    public function render()
    {
        return view('livewire.student.setting.profile');
    }
}
