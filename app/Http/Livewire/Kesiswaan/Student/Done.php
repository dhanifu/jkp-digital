<?php

namespace App\Http\Livewire\Kesiswaan\Student;

use App\Models\Jkp;
use App\Models\Student;
use Livewire\Component;

class Done extends Component
{
    public $rayon_id;
    public $weeks;
    public $minggu_ke;
    public $perPage = 10;

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
        $rayon_id = $this->rayon_id;

        $students = Student::select('id', 'user_id', 'nis', 'name', 'kelas', 'rayon_id', 'rombel_id')
            ->where('rayon_id', $rayon_id)
            ->with('akun:id,email,pemilik_id')->orderBy('name', 'ASC')->get();

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

        return view('livewire.kesiswaan.student.done', compact('dones'));
    }
}
