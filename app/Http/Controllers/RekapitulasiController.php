<?php

namespace App\Http\Controllers;

use App\Exports\Kesiswaan\RekapSemuaMultisheet;
use App\Exports\RekapitulasiMultiSheetExport;
use App\Http\Controllers\Controller;
use App\Models\Jkp;
use App\Models\Rayon;
use App\Models\Student;
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

    public function exportExcelFromKesiswaan($rayon_id)
    {
        $minggu_ke = request()->minggu_ke;

        $students = Student::where('rayon_id', $rayon_id)
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

    public function exportAll()
    {
        $minggu_ke = request()->minggu_ke;
        $students = Student::select([
            'id', 'user_id', 'nis', 'name',
            'rayon_id', 'rombel_id', 'kelas',
            'agama', 'gender'
        ])->with('akun:id,email,pemilik_id', 'rayon:id,name', 'rombel:id,name')
            ->orderBy('name', 'ASC')->get();

        $jkp_dones = Jkp::with('assignment')->whereHas('assignment', function ($q) use ($minggu_ke) {
            $q->where('minggu_ke', $minggu_ke);
        })->get();

        $rayons = Rayon::select(['id', 'name', 'teacher_id'])
            ->with('teacher:id,user_id,name', 'teacher.akun:id,email,pemilik_id')
            ->orderBy('name')->get();

        $done = [];
        $user_id = [];
        $jkp_user_id = [];

        foreach ($jkp_dones as $key => $item) {
            foreach ($students as $index => $value) {
                $user_id[$index] = $value->akun->id;
                $jkp_user_id[$key] = $item->user_id;

                if ($jkp_user_id[$key] == $user_id[$index]) {
                    $done[] = $value;
                } else {
                    $done[] = [];
                }
            }
        }

        $dones = array_values(array_filter($done));

        $siswas = [];

        foreach ($rayons as $key => $ray) {
            $siswas[] = [
                $ray->id =>
                Student::select([
                    'id', 'user_id', 'nis', 'name',
                    'rayon_id', 'rombel_id', 'kelas',
                    'agama', 'gender'
                ])->where('rayon_id', $ray->id)->with('akun:id,email,pemilik_id', 'rayon:id,name', 'rombel:id,name')
                    ->orderBy('name', 'ASC')->get()->toArray()
            ];
        }

        if (!empty($dones)) {
            foreach ($siswas as $key => $rayon) {
                foreach ($rayon as $i => $siswa) {
                    foreach ($siswa as $index => $item) {
                        foreach ($dones as $selesai) {
                            if ($item['akun']['id'] == $selesai['akun']['id']) {
                                unset($siswas[$key][$i][$index]);
                            }
                        }
                    }
                }
            }
        }

        $siswa_missings = [];
        foreach ($siswas as $key => $value) {
            foreach ($value as $index => $item) {
                $siswa_missings[] = [$index => array_values($item)];
            }
        }

        return $this->excel->download(
            new RekapSemuaMultisheet($minggu_ke, $dones, $siswa_missings),
            "Rekapitulasi-Minggu_ke_{$minggu_ke}.xlsx"
        );
    }
}
