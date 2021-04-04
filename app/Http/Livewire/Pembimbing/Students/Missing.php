<?php

namespace App\Http\Livewire\Pembimbing\Students;

use App\Models\Assignment;
use App\Models\AssignmentJkp;
use App\Models\Jkp;
use App\Models\Rayon;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Missing extends Component
{
    public $minggu_ke;
    public $perPage = 10;
    public $weeks;

    protected $listeners = [
        'refreshMissing' => '$refresh',
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        $minggu_ke = $this->minggu_ke;
        $current_date = strtotime(date('Y-m-d H:i:s'));

        if ($minggu_ke == null) {
            $minggu_ke = $this->weeks[0]->minggu_ke;
        }

        $pemray = Auth::user()->teacher;
        $rayon = Rayon::where('teacher_id', $pemray->id)->first();

        $students = Student::where('rayon_id', $rayon->id)
            ->with('akun:id,email,pemilik_id', 'rombel')->orderBy('name', 'ASC')->get();

        $jkp_dones = Jkp::with('assignment')->whereHas('assignment', function ($q) use ($minggu_ke) {
            $q->where('minggu_ke', $minggu_ke);
        })->latest()->paginate($this->perPage);

        $done = [];
        $user_id = [];
        $jkp_user_id = [];

        foreach ($jkp_dones as $key => $item) {
            foreach ($students as $index => $value) {
                $user_id[$index] = $value->akun->id;
                $jkp_user_id[$key] = $item->user_id;

                $values = $value->toArray();

                $done[] = $jkp_user_id[$key] == $user_id[$index] ? $values : [];
            }
        }

        $dones = array_filter($done);
        $missings = $students->toArray();

        if (!empty($dones)) {
            foreach ($missings as $key => $siswa) {
                foreach ($dones as $selesai) {
                    if ($siswa["akun"]["id"] == $selesai["akun"]["id"]) {
                        unset($missings[$key]);
                    }
                }
            }
        }

        return view('livewire.pembimbing.students.missing', compact('missings'));
    }
}
