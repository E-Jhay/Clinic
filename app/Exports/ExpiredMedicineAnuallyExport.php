<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class ExpiredMedicineAnuallyExport implements FromView, ShouldAutoSize, WithEvents
{

    private $reports, $totalExpired, $year;

    public function __construct($reports, $totalExpired, $year)
    {
        $this->reports = $reports;
        $this->totalExpired = $totalExpired;
        $this->year = $year;
    }

    public function view(): View
    {
        return view('exports.expired-medicine-anually', [
            'reports' => $this->reports,
            'totalExpired' => $this->totalExpired,
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
