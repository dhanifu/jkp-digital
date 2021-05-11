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
    public $search = null;
    public $detail = false;
    public $siswa = null;

    protected $listeners = [
        'refreshDone' => '$refresh',
        'load-more' => 'loadMore',
        'closeDetail' => 'closeDetail',
    ];

    public function showDetail($id)
    {
        $this->detail = true;
        $this->siswa = Student::with(
            'rombel:id,name',
            'rayon:id,teacher_id,name',
            'rayon.teacher:id,name'
        )->find($id);
    }

    public function closeDetail()
    {
        $this->detail = false;
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        $minggu_ke = $this->minggu_ke;
        $search = $this->search;

        $pemray = Auth::user()->teacher;

        $rayon = Rayon::where('teacher_id', $pemray->id)->first();

        if ($search != null) {
            $students = Student::select('id', 'user_id', 'nis', 'name', 'kelas', 'rayon_id', 'rombel_id')
                ->where('rayon_id', $rayon->id)
                ->where('name', 'like', "%$search%")
                ->orWhere('nis', 'like', "%$search%")
                ->orWhere('kelas', 'like', "%$search%")
                ->orWhereHas('rombel', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->with('akun:id,email,pemilik_id')->get();
        } else {
            $students = Student::select('id', 'user_id', 'nis', 'name', 'kelas', 'rayon_id', 'rombel_id')
                ->where('rayon_id', $rayon->id)
                ->with('akun:id,email,pemilik_id')->get();
        }

        if ($minggu_ke == null) {
            $minggu_ke = $this->weeks[0]->minggu_ke;
        }

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

                $done[] = $jkp_user_id[$key] == $user_id[$index] ? $value : [];
            }
        }

        $dones = array_filter($done);

        return view('livewire.pembimbing.students.done', compact('dones'));
    }
}
