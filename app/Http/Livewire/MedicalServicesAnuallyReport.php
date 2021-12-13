<?php

namespace App\Http\Livewire;

use App\Exports\MedicalServicesAnuallyExport;
use App\Models\Designation;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class MedicalServicesAnuallyReport extends Component
{
    public $year;

    public function mount()
    {
        $this->year = now()->year;
        // $this->monthYear = Carbon::createFromFormat('m', $this->month)->format('F')." ". now()->year;
    }

    public function render()
    {
        return view('livewire.medical-services-anually-report', [
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
        return Excel::download(new MedicalServicesAnuallyExport($this->report, $this->designations, $this->totalCountPerDesignation, $this->totalCount, $this->year), 'anually-medical-services-report.' .$ext);
    }
}
