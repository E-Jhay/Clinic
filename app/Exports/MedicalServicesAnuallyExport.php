<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class MedicalServicesAnuallyExport implements FromView, ShouldAutoSize, WithEvents
{

    private $report, $designations, $totalCountPerDesignation, $totalCount, $year;

    public function __construct($report, $designations, $totalCountPerDesignation, $totalCount, $year)
    {
        $this->report = $report;
        $this->designations = $designations;
        $this->totalCountPerDesignation = $totalCountPerDesignation;
        $this->totalCount = $totalCount;
        $this->year = $year;
    }

    public function view(): View
    {
        return view('exports.medical-services-anually', [
            'report' => $this->report,
            'designations' => $this->designations,
            'totalCountPerDesignation' => $this->totalCountPerDesignation,
            'totalCount' => $this->totalCount,
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
