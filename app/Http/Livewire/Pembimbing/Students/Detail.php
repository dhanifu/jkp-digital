<?php

namespace App\Http\Livewire\Pembimbing\Students;

use App\Models\Assignment;
use App\Models\Jkp;
use Livewire\Component;

class Detail extends Component
{
    public $siswa;
    public $weeks;
    public $minggu_ke;

    public function render()
    {
        $siswa = $this->siswa;
        $minggu_ke = $this->minggu_ke;

        if ($minggu_ke == null) {
            $minggu_ke = $this->weeks[0]->minggu_ke;
        }

        $assignment = Assignment::where('minggu_ke', $minggu_ke)->first();
        $jkp = Jkp::where('assignment_id', $assignment->id)
            ->where('user_id', $siswa->user_id)
            ->with([
                'user:id,pemilik_id',
                'user.student:id,rayon_id',
                'user.student.rayon:id,name'
            ])->first();

        $types = [
            'file_keagamaan', 'file_literasi',
            'file_lingkungan', 'file_kesehatan'
        ];
        $tipe = [
            'Keagamaan', 'Literasi',
            'Lingkungan', 'Kesehatan',
        ];

        if ($siswa->kelas == '10') {
            $types[4] = 'file_pramuka';
            $tipe[4] = 'Pramuka';
        }

        return view('livewire.pembimbing.students.detail', compact('assignment', 'jkp', 'types', 'tipe'));
    }
}
