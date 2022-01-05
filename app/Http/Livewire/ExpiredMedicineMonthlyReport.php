<?php

namespace App\Http\Livewire;

use App\Exports\ExpiredMedicineMonthlyExport;
use App\Exports\MedicineMonthlyExport;
use App\Models\Designation;
use App\Models\Medicine;
use App\Models\ReleasedMedicine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class ExpiredMedicineMonthlyReport extends Component
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
        return view('livewire.expired-medicine-monthly-report', [
            'reports'        =>  $this->reports,
            'totalExpired'    =>  $this->totalExpired,
        ]);
    }

    public function getReportsProperty()
    {
        $reports = Medicine::select([
            'name',
            'expiration_day',
            'stock',
            // DB::raw("DATE_FORMAT(created_at, '%m') as month"),
            // DB::raw('SUM(stock) as medicineCount'),
        ])
        ->whereYear('expiration_day', $this->year)
        ->whereMonth('expiration_day', $this->month)
        ->where('isExpired', 1)
        ->get();

        return $reports;
        // dd($query);
    }

    
    public function getTotalExpiredProperty()
    {
        return Medicine::select(DB::raw('SUM(stock) as expired'))
        ->whereYear('expiration_day', $this->year)
        ->whereMonth('expiration_day', $this->month)
        ->where('isExpired', 1)
        ->get();
    }

    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx']), Response::HTTP_NOT_FOUND);
        return Excel::download(new ExpiredMedicineMonthlyExport($this->reports, $this->totalExpired, $this->month, $this->year), 'expired-medicine-monthly-medicine-report.' .$ext);
    }
}
