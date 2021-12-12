<?php

namespace App\Http\Livewire;

use App\Models\Designation;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

use Livewire\Component;

class PatientCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $isOpen = 0;
    public $searchTerm;
    public $sortDesignation;
    public $titlePage = "Patient Records";
    public $sortBy = 'created_at';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $name, $designation_id, $diagnosis;

    // protected $listeners = [
    //     'addStockConfirmed' => 'addStockConfirmed',
    //     'removeStockConfirmed' => 'removeStockConfirmed',

    // ];

    public function render()
    {
        return view('livewire.Patient-crud',[
            'patients' =>  $this->Patient,
            'designations' =>  Designation::all(),
        ]);
    }

    public function getPatientProperty()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $sortDesignation = $this->sortDesignation;
        return Patient::select('id',
                'name',
                'diagnosis',
                'designation_id',
                'course_id',
            )
            ->when($sortDesignation, function($q) use ($sortDesignation, $searchTerm){
                $q->where('designation_id', $sortDesignation)
                    ->where('name', 'like', $searchTerm);
                // ->when($searchTerm, function ($query) use ($searchTerm){
                //     $query->where('name', 'like', $searchTerm)
                //     ->orWhere('address', 'like', $searchTerm);
                // });
                }, function($q) use ($searchTerm){
                    $q->where('name', 'like', $searchTerm);
                })
            ->groupBy('name')
            ->groupBy('designation_id')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function viewRecords($name, $designation_id)
    {
        $patientRecords = Patient::where('name', $name);
        return redirect()->to('/patient-record/'.$name.'/'.$designation_id);
    }

    public function updatedSortDesignation()
    {
        $fetchDesignations = Designation::select('id', 'name')->get();
        foreach($fetchDesignations as $fetchDesignation){
            if($this->sortDesignation == $fetchDesignation['id'])
                $this->titlePage = $fetchDesignation['name'] ." Patient Records";
            elseif($this->sortDesignation == '')
                $this->titlePage = "Patient Records";
        }
    }
    // public function addStock($id)
    // {
    //     $this->dispatchBrowserEvent('swal:addStock',[
    //         'type'  =>  'warning',
    //         'title' =>  'Add Stock on the selected Item',
    //         'text'  =>  '',
    //         'id'    =>  $id,
    //     ]);
    // }
    // public function addStockConfirmed($quantity, $id)
    // {
    //     try{
    //         $existingPatient = Patient::findOrFail($id);
    //             if($existingPatient){
    //                 $existingPatient->update([
    //                     'stock'  =>  $existingPatient->stock + $quantity,
    //                 ]);
    //             }
    //         $this->dispatchBrowserEvent('alert',[
    //             'type'=>'success',
    //             'message'=>'Stock Added'
    //         ]);
    //     }catch(\Exception $e){
    //         $this->dispatchBrowserEvent('alert',[
    //             'type'=>'error',
    //             'message'=>"Something goes wrong"
    //         ]);
    //     }
    // }


}
