<?php

namespace App\Http\Livewire;

use App\Exports\MedicineQuarterlyExport;
use App\Models\Designation;
use App\Models\ReleasedMedicine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class MedicineQuarterlyReport extends Component
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
        return view('livewire.medicine-quarterly-report', [
            'designations'  =>  $this->designations,
            'report'        =>  $this->report,
            'totalCountPerDesignation'        =>  $this->totalCountPerDesignation,
            'totalCount'    =>  $this->totalCount,
        ]);
    }
    public function getReportProperty()
    {
        $query = ReleasedMedicine::select([
            'medicine_name',
            'designation_id',
            // DB::raw("DATE_FORMAT(created_at, '%m') as month"),
            DB::raw('COUNT(id) as medicineCount'),
        ])
        ->whereYear('created_at', $this->year)
        ->whereMonth('created_at', '>=', $this->start)
        ->whereMonth('created_at', '<=', $this->end)
        ->groupBy('designation_id')
        ->groupBy('medicine_name')
        ->orderBy('medicine_name')
        ->get();

        $report = [];
        $medicineNames = $this->medicineNames;
        // Set key without to the report Array 
        $medicineNames->each(function ($item, $key) use (&$report){
            $report[$key] = [];
        });

        // Sets value to the report array
        $query->each(function ($item) use (&$report){
            $report[$item->medicine_name][$item->designation_id] = [
                'count' => $item->medicineCount
            ];
        });

        return $report;
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

    public function getDesignationsProperty()
    {
        return Designation::select('id', 'name')->get();
    }

    public function getMedicineNamesProperty()
    {
        return ReleasedMedicine::select('medicine_name', 'id')
        ->groupBy('medicine_name')
        ->orderBy('medicine_name')
        ->pluck('id', 'medicine_name');
    }

    public function getTotalCountPerDesignationProperty()
    {
        return ReleasedMedicine::select([
            'designation_id',
            DB::raw('COUNT(id) as total'),
        ])
        ->whereYear('created_at', $this->year)
        ->whereMonth('created_at', '>=', $this->start)
        ->whereMonth('created_at', '<=', $this->end)
        ->groupBy('designation_id')
        ->orderBy('designation_id')
        ->get()
        ->pluck('total', 'designation_id')
        ->toArray();
    }

    public function getTotalCountProperty()
    {
        return ReleasedMedicine::select('id')
        ->whereYear('created_at', $this->year)
        ->whereMonth('created_at', '>=', $this->start)
        ->whereMonth('created_at', '<=', $this->end)
        ->count();
    }

    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx']), Response::HTTP_NOT_FOUND);
        return Excel::download(new MedicineQuarterlyExport($this->report, $this->designations, $this->totalCountPerDesignation, $this->totalCount, $this->quarter, $this->year), 'quarterly-medicine-report.' .$ext);
    }
}
