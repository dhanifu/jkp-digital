<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RekapitulasiMultiSheetExport implements WithMultipleSheets
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

        foreach ($this->dones as $key => $value) {
            $dones[] = [
                '#' => $key + 1,
                'name' => $value->name,
                'nis' => $value->nis,
                'kelas' => $value->kelas,
                'rombel' => $value->rombel->name,
                'rayon' => $value->rayon->name,
            ];
        }

        foreach ($this->missings as $index => $item) {
            $missings[] = [
                '#' => $index + 1,
                'name' => $item['name'],
                'nis' => $item['nis'],
                'kelas' => $item['kelas'],
                'rombel' => $item['rombel']['name'],
                'rayon' => $item['rayon']['name'],
            ];
        }

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

        for ($i = 1; $i <= 2; $i++) {
            if ($i == 1) {
                $sheets[] = new RekapitulasiExport($this->minggu_ke, $dones, 'Sudah Mengumpulkan');
            } else {
                $sheets[] = new RekapitulasiExport($this->minggu_ke, $missings, 'Belum Mengumpulkan');
            }
        }


        return $sheets;
    }
}
