<?php

namespace App\Http\Controllers\Pembimbing;

use App\Exports\RekapitulasiExport;
use App\Exports\RekapitulasiMultiSheetExport;
use App\Http\Controllers\Controller;
use App\Models\Jkp;
use App\Models\Rayon;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel;

class RekapitulasiController extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->middleware(['auth', 'role:pembimbing|kesiswaan']);
        $this->excel = $excel;
    }

    public function exportExcel()
    {
        $minggu_ke = request()->minggu_ke;
        $pemray = Auth::user()->teacher;
        $rayon = Rayon::where('teacher_id', $pemray->id)->first();

        $students = Student::where('rayon_id', $rayon->id)
            ->with('akun:id,email,pemilik_id', 'rayon:id,name', 'rombel:id,name')
            ->orderBy('name', 'ASC')->get();

        $jkp_dones = Jkp::with('assignment')->whereHas('assignment', function ($q) use ($minggu_ke) {
            $q->where('minggu_ke', $minggu_ke);
        })->get();

        $done = [];
        $missing = [];
        $user_id = [];
        $jkp_user_id = [];

        foreach ($jkp_dones as $key => $item) {
            foreach ($students as $index => $value) {
                $user_id[$index] = $value->akun->id;
                $jkp_user_id[$key] = $item->user_id;

                $done[] = $jkp_user_id[$key] == $user_id[$index] ? $value : [];

                $values = $value->toArray();
                $missing[] = $jkp_user_id[$key] == $user_id[$index] ? $values : [];
            }
        }

        $dones = array_values(array_filter($done));
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

        $missings = array_values($missings);

        return $this->excel->download(
            new RekapitulasiMultiSheetExport($minggu_ke, $dones, $missings),
            "Rekapitulasi(Minggu_ke_$minggu_ke).xlsx"
        );
    }
}
