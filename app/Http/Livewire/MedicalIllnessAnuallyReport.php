<?php

namespace App\Http\Livewire;

use App\Exports\MedicalIllnessAnuallyExport;
use App\Models\Designation;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class MedicalIllnessAnuallyReport extends Component
{
    public $year;

    public function mount()
    {
        $this->year = now()->year;
        // $this->monthYear = Carbon::createFromFormat('m', $this->month)->format('F')." ". now()->year;
    }

    public function render()
    {
        return view('livewire.medical-illness-anually-report', [
            'designations'  =>  $this->designations,
            'report'        =>  $this->report,
            'totalCountPerDesignation'        =>  $this->totalCountPerDesignation,
            'totalCount'    =>  $this->totalCount,
        ]);
    }

    public function getReportProperty()
    {
        $query = Patient::select([
            'diagnosis',
            'designation_id',
            // DB::raw("DATE_FORMAT(created_at, '%m') as month"),
            DB::raw('COUNT(id) as diagnosisCount'),
        ])
        ->whereYear('created_at', $this->year)
        ->groupBy('designation_id')
        ->groupBy('diagnosis')
        ->orderBy('diagnosis')
        ->get();

        $report = [];
        $medicalIllness = $this->medicalIllness;
        // Set key without to the report Array 
        $medicalIllness->each(function ($item, $key) use (&$report){
            $report[$key] = [];
        });

        // Sets value to the report array
        $query->each(function ($item) use (&$report){
            $report[$item->diagnosis][$item->designation_id] = [
                'count' => $item->diagnosisCount
            ];
        });

        return $report;
        // dd($report);
    }

    public function getDesignationsProperty()
    {
        return Designation::select('id', 'name')->get();
    }

    public function getMedicalIllnessProperty()
    {
        return Patient::select('diagnosis', 'id')
        ->groupBy('diagnosis')
        ->orderBy('diagnosis')
        ->pluck('id', 'diagnosis');
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
        return Excel::download(new MedicalIllnessAnuallyExport($this->report, $this->designations, $this->totalCountPerDesignation, $this->totalCount, $this->year), 'anually-medical-illness-report.' .$ext);
    }
}
