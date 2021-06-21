<?php

namespace App\Exports\Kesiswaan;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RekapSemuaMultisheet implements WithMultipleSheets
{
    private $minggu_ke, $dones, $missings;

    public function __construct($minggu_ke, $dones, $missings)
    {
        $this->minggu_ke = $minggu_ke;
        $this->dones = $dones;
        $this->missings = $missings;
    }

    public function sheets(): array
    {
        $sheets = [];
        $dones = [];
        $missings = [];

        if (empty($this->dones)) {
            $dones[] = [
                '#' => 1,
                'name' => "Kosong",
                'nis' => "Kosong",
                'kelas' => "Kosong",
                'rombel' => "Kosong",
                'rayon' => "Kosong",
            ];
        }
        if (empty($this->missings)) {
            $missings[] = [
                '#' => 1,
                'name' => "Kosong",
                'nis' => "Kosong",
                'kelas' => "Kosong",
                'rombel' => "Kosong",
                'rayon' => "Kosong",
            ];
        }

        foreach ($this->dones as $key => $value) {
            $dones[] = [
                '#' => $key + 1,
                'rayon' => $value->rayon->name,
                'name' => $value->name,
                'nis' => $value->nis,
                'kelas' => $value->kelas,
                'rombel' => $value->rombel->name,
            ];
        }
        foreach ($dones as $key => $value) {
            $dones_rayon[$key] = $value['rayon'];
            $dones_name[$key] = $value['name'];
        }

        array_multisort($dones_rayon, SORT_ASC, $dones_name, SORT_ASC, $dones);

        foreach ($this->missings as $item) {
            foreach ($item as $data) {
                foreach ($data as $index => $value) {
                    $missings[] = [
                        '#' => $index + 1,
                        'rayon' => $value['rayon']['name'],
                        'name' => $value['name'],
                        'nis' => $value['nis'],
                        'kelas' => $value['kelas'],
                        'rombel' => $value['rombel']['name'],
                    ];
                }
            }
        }
        foreach ($missings as $key => $value) {
            $missing_rayon[$key] = $value['rayon'];
            $missing_name[$key] = $value['name'];
        }

        array_multisort($missing_rayon, SORT_ASC, $missing_name, SORT_ASC, $missings);

        for ($i = 1; $i <= 2; $i++) {
            if ($i == 1) {
                $sheets[] = new RekapSemua($this->minggu_ke, $dones, 'Sudah Mengumpulkan');
            } else {
                $sheets[] = new RekapSemua($this->minggu_ke, $missings, 'Belum Mengumpulkan');
            }
        }

        return $sheets;
    }
}
