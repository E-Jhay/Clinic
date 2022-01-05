<?php

namespace App\Http\Livewire;

use App\Exports\ExpiredMedicineAnuallyExport;
use App\Models\Medicine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class ExpiredMedicineAnuallyReport extends Component
{

    public $year;

    public function mount()
    {
        $this->year = now()->year;

    }

    public function render()
    {
        return view('livewire.expired-medicine-anually-report', [
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
        ->where('isExpired', 1)
        ->get();

        return $reports;
        // dd($query);
    }
    
    public function getTotalExpiredProperty()
    {
        return Medicine::select(DB::raw('SUM(stock) as expired'))
        ->whereYear('expiration_day', $this->year)
        ->where('isExpired', 1)
        ->get();
    }

    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx']), Response::HTTP_NOT_FOUND);
        return Excel::download(new ExpiredMedicineAnuallyExport($this->reports, $this->totalExpired, $this->year), 'expired-medicine-anually-medicine-report.' .$ext);
    }
}
