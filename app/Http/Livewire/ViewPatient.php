<?php

namespace App\Http\Livewire;

use App\Models\Designation;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

use Livewire\Component;

class ViewPatient extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $isOpen = 0;
    public $searchTerm;
    public $titleName;
    public $from_designation_id;
    public $sortDesignation;
    public $sortBy = 'created_at';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $patientRecordId;
    public $name, $designation_id, $diagnosis, $complaints, $medical_service, $medicines_given;

    // protected $listeners = [
    //     'addStockConfirmed' => 'addStockConfirmed',
    //     'removeStockConfirmed' => 'removeStockConfirmed',

    // ];

    public function mount($titleName, $from_designation_id)
    {
        $this->titleName = $titleName;
        $this->from_designation_id = $from_designation_id;
        // dd($this->$from_designation_id);
    }
    public function render()
    {
        return view('livewire.view-patient',[
            'patientRecords' =>  $this->PatientRecords,
            'designations' =>  Designation::all(),
        ]);
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function resetFields()
    {
        $this->name = '';
        $this->designation_id    = '';
        $this->diagnosis  = '';
        $this->complaints  = '';
        $this->medical_service  = '';
        $this->medicines_given  = '';
    }

    public function getPatientRecordsProperty()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $sortDesignation = $this->sortDesignation;
        $titleName = $this->titleName;
        $from_designation_id = $this->from_designation_id;
        // dd($from_designation_id);
        // dd($this->from_designation_id);
        return Patient::select('id',
                'name',
                'diagnosis',
                'designation_id', 
                'created_at', 
            )
            ->when($sortDesignation, function($q) use ($sortDesignation, $searchTerm){
                $q->where('designation_id', $sortDesignation)
                    ->where('diagnosis', 'like', $searchTerm);
                // ->when($searchTerm, function ($query) use ($searchTerm){
                //     $query->where('name', 'like', $searchTerm)
                //     ->orWhere('address', 'like', $searchTerm);
                // });
                }, function($q) use ($searchTerm){
                    $q->where('diagnosis', 'like', $searchTerm);
                })
            ->where('name', $titleName)
            ->where('designation_id', $from_designation_id)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function edit($id)
    {
        // $patientRecords = Patient::where('name', $name);
        $patientRecords = Patient::findOrFail($id);
        $this->name = $patientRecords->name;
        $this->designation_id = $patientRecords->designation_id;
        $this->complaints = $patientRecords->complaints;
        $this->diagnosis = $patientRecords->diagnosis;
        $this->medical_service = $patientRecords->medical_service;
        $this->medicines_given = $patientRecords->medicines_given;
        $this->patientRecordId = $id;

        $this->emit('gotoTop');
        $this->openModal();
    }

    public function update()
    {
        try{
            Patient::find($this->patientRecordId)->update([
                'name'              =>      strtolower($this->name),
                'designation_id'    =>      $this->designation_id,
                'complaints'        =>      strtolower($this->complaints),
                'diagnosis'         =>      strtolower($this->diagnosis),
                'medical_service'   =>      strtolower($this->medical_service),
                'medicines_given'   =>      strtolower($this->medicines_given),
            ]);

            $this->resetFields();
            $this->closeModal();
            // dd($medicine_given_list);
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'DTR Updated'
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong"
            ]);
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
