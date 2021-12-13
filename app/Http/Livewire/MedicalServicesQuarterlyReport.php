<?php

namespace App\Http\Livewire;

use App\Exports\MedicalServicesQuarterlyExport;
use App\Models\Designation;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class MedicalServicesQuarterlyReport extends Component
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
        return view('livewire.medical-services-quarterly-report', [
            'designations'  =>  $this->designations,
            'report'        =>  $this->report,
            'totalCountPerDesignation'        =>  $this->totalCountPerDesignation,
            'totalCount'    =>  $this->totalCount,
        ]);
    }

    public function getReportProperty()
    {
        $query = Patient::select([
            'medical_service',
            'designation_id',
            // DB::raw("DATE_FORMAT(created_at, '%m') as month"),
            DB::raw('COUNT(id) as servicesCount'),
        ])
        ->whereYear('created_at', $this->year)
        ->whereMonth('created_at', '>=', $this->start)
        ->whereMonth('created_at', '<=', $this->end)
        ->groupBy('designation_id')
        ->groupBy('medical_service')
        ->orderBy('medical_service')
        ->get();

        $report = [];
        $medicalService = $this->medicalService;
        // Set key without to the report Array 
        $medicalService->each(function ($item, $key) use (&$report){
            $report[$key] = [];
        });

        // Sets value to the report array
        $query->each(function ($item) use (&$report){
            $report[$item->medical_service][$item->designation_id] = [
                'count' => $item->servicesCount
            ];
        });

        return $report;
        // dd($report);
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

    public function getMedicalServiceProperty()
    {
        return Patient::select('medical_service', 'id')
        ->groupBy('medical_service')
        ->orderBy('medical_service')
        ->pluck('id', 'medical_service');
    }

    public function getTotalCountPerDesignationProperty()
    {
        return Patient::select([
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
        return count($this->report);
    }

    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx']), Response::HTTP_NOT_FOUND);
        return Excel::download(new MedicalServicesQuarterlyExport($this->report, $this->designations, $this->totalCountPerDesignation, $this->totalCount, $this->month, $this->year), 'quarterly-medical-services-report.' .$ext);
    }
}
