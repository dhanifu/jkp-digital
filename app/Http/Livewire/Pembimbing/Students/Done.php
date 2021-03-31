<?php

namespace App\Http\Livewire\Pembimbing\Students;

use App\Models\Assignment;
use App\Models\Jkp;
use App\Models\Rayon;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Done extends Component
{
    public $minggu_ke;
    public $perPage = 10;
    public $weeks;

    protected $listeners = [
        'refreshDone' => '$refresh',
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        $minggu_ke = $this->minggu_ke;

        $pemray = Auth::user()->teacher;

        $rayon = Rayon::where('teacher_id', $pemray->id)->first();

        $students = Student::where('rayon_id', $rayon->id)
            ->with('akun:id,email,pemilik_id')->get();

        $jkp_dones = Jkp::with('assignment');

        if ($minggu_ke != null) {
            $jkp_dones = $jkp_dones->whereHas('assignment', function($q) use ($minggu_ke){
                $q->where('minggu_ke', $minggu_ke);
            })->latest()->get();
        } else {
            $minggu_ke = $this->weeks[0]->minggu_ke;
            $jkp_dones = $jkp_dones->whereHas('assignment', function($q) use ($minggu_ke){
                $q->where('minggu_ke', $minggu_ke);
            })->latest()->get();
        }

        $done = [];
        $user_id = [];
        $jkp_user_id = [];

        foreach ($jkp_dones as $key => $item) {
            foreach ($students as $index => $value) {
                $user_id[$index] = $value->akun->id;
                $jkp_user_id[$key] = $item->user_id;

                $done[] = $jkp_user_id[$key] == $user_id[$index] ? $value : [];
            }
        }

        $dones = array_filter($done);

        return view('livewire.pembimbing.students.done', compact('dones'));
    }
}
