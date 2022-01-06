<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class BmiMonthlyExport implements FromView, ShouldAutoSize, WithEvents
{

    private $reports, $month, $year;

    public function __construct($reports, $month, $year)
    {
        $this->reports = $reports;
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {
        return view('exports.bmi-monthly', [
            'reports' => $this->reports,
            'month' => $this->month,
            'year' => $this->year,
        ]);
        
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $to = $event->sheet->getDelegate()->getHighestRowAndColumn();

                $event->sheet->getStyle('A1:'.$to['column'].$to['row'])->getAlignment()->applyFromArray(
                    array(
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    )
                );
            },
        ];
    }
    
}
