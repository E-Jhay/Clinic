<?php

namespace App\Http\Livewire;

use App\Exports\MedicineAnuallyExport;
use App\Models\Designation;
use App\Models\ReleasedMedicine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class MedicineAnuallyReport extends Component
{
    public $year;

    public function mount()
    {
        $this->year = now()->year;

    }

    public function render()
    {
        return view('livewire.medicine-anually-report', [
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
        ->count();
    }

    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx']), Response::HTTP_NOT_FOUND);
        return Excel::download(new MedicineAnuallyExport($this->report, $this->designations, $this->totalCountPerDesignation, $this->totalCount, $this->year), 'anually-medicine-report.' .$ext);
    }
}
