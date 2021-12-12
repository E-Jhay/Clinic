<?php

namespace App\Http\Livewire;

use App\Exports\MedicineExport;
use App\Models\Designation;
use App\Models\ReleasedMedicine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class MedicineReport extends Component
{
    public $month, $year;
    public $option = 1;

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        // $this->monthYear = Carbon::createFromFormat('m', $this->month)->format('F')." ". now()->year;
    }

    public function render()
    {
        return view('livewire.medicine-report', [
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
        ->whereMonth('created_at', $this->month)
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

    public function changeOption($option)
    {
        $this->option = $option;
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
        ->whereMonth('created_at', $this->month)
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
        ->whereMonth('created_at', $this->month)
        ->count();
    }

    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx']), Response::HTTP_NOT_FOUND);
        return Excel::download(new MedicineExport($this->report, $this->designations, $this->totalCountPerDesignation, $this->totalCount, $this->month, $this->year), 'monthly-medicine-report.' .$ext);
    }
}
