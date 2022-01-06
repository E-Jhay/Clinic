<?php

namespace App\Http\Livewire;

use App\Exports\BmiMonthlyExport;
use App\Models\Bmi;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class BmiMonthlyReport extends Component
{
    public $month, $year;

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        // $this->monthYear = Carbon::createFromFormat('m', $this->month)->format('F')." ". now()->year;
    }

    public function render()
    {
        return view('livewire.bmi-monthly-report', [
            'reports'   => $this->reports
        ]);
    }

    public function getReportsProperty()
    {
        return Bmi::with('classification', 'health_profile')
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx']), Response::HTTP_NOT_FOUND);
        return Excel::download(new BmiMonthlyExport($this->reports, $this->month, $this->year), 'bmi-monthly-report.' .$ext);
    }
}
