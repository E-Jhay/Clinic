<?php

namespace App\Http\Livewire;

use App\Exports\ExpiredMedicineQuarterlyExport;
use App\Models\Medicine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class ExpiredMedicineQuarterlyReport extends Component
{

    public $month, $year;
    public $quarter;
    public $start, $end;

    public function mount()
    {
        $this->year = now()->year;

        if(now()->month >= 1 && now()->month <= 3){
            $this->start = '01';
            $this->end = '03';
            $this->quarter = '1st';
        }
        elseif(now()->month >= 4 && now()->month <= 6){
            $this->start = '04';
            $this->end = '06';
            $this->quarter = '2nd';
        }
        elseif(now()->month >= 7 && now()->month <= 9){
            $this->start = '07';
            $this->end = '09';
            $this->quarter = '3rd';
        }
        elseif(now()->month >= 10 && now()->month <= 12){
            $this->start = '10';
            $this->end = '12';
            $this->quarter = '4th';
        }
        // $this->monthYear = Carbon::createFromFormat('m', $this->month)->format('F')." ". now()->year;
    }

    public function render()
    {
        return view('livewire.expired-medicine-quarterly-report', [
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
        ->whereMonth('expiration_day', '>=', $this->start)
        ->whereMonth('expiration_day', '<=', $this->end)
        ->where('isExpired', 1)
        ->get();

        return $reports;
        // dd($query);
    }

    public function updatedQuarter()
    {
        if($this->quarter == '2nd'){
            $this->start = '04';
            $this->end = '06';
        }
        elseif($this->quarter == '3rd'){
            $this->start = '07';
            $this->end = '09';
        }
        elseif($this->quarter == '4th'){
            $this->start = '10';
            $this->end = '12';
        }
        else{
            $this->start = '01';
            $this->end = '03';
        }

        // dd($this->costPerCustomer);
    }
    
    public function getTotalExpiredProperty()
    {
        return Medicine::select(DB::raw('SUM(stock) as expired'))
        ->whereYear('expiration_day', $this->year)
        ->whereMonth('expiration_day', '>=', $this->start)
        ->whereMonth('expiration_day', '<=', $this->end)
        ->where('isExpired', 1)
        ->get();
    }

    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx']), Response::HTTP_NOT_FOUND);
        return Excel::download(new ExpiredMedicineQuarterlyExport($this->reports, $this->totalExpired, $this->quarter, $this->year), 'expired-medicine-quarterly-medicine-report.' .$ext);
    }
}
