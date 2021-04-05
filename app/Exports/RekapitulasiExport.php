<?php

namespace App\Exports;

use App\Models\Jkp;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class RekapitulasiExport implements
    FromArray,
    ShouldAutoSize,
    WithHeadings,
    WithEvents,
    WithCustomStartCell,
    WithTitle
{
    use Exportable;

    private $minggu_ke, $data, $sheet_name;

    public function __construct($minggu_ke, $data, $sheet_name)
    {
        $this->minggu_ke = $minggu_ke;
        $this->data = $data;
        $this->sheet_name = $sheet_name;
    }

    public function array(): array
    {
        return $this->data;
    }


    public function headings(): array
    {
        return [
            '#',
            'Nama',
            'NIS',
            'Kelas',
            'Rombel',
            'Rayon',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A2:F2')->applyFromArray([
                    'font' => ['bold' => true]
                ]);
            }
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function title(): string
    {
        return $this->sheet_name;
    }
}
