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
    public $name;
    public $sortDesignation;
    public $sortBy = 'created_at';
    public $sortDirection = 'asc';
    public $perPage = 10;
    // public $name, $designation_id, $diagnosis;

    // protected $listeners = [
    //     'addStockConfirmed' => 'addStockConfirmed',
    //     'removeStockConfirmed' => 'removeStockConfirmed',

    // ];

    public function mount($name)
    {
        $this->name = $name;
    }
    public function render()
    {
        return view('livewire.view-patient',[
            'patientRecords' =>  $this->PatientRecords,
            'designations' =>  Designation::all(),
        ]);
    }

    public function getPatientRecordsProperty()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $sortDesignation = $this->sortDesignation;
        $name = $this->name;
        return Patient::select('id',
                'name',
                'diagnosis',
                'designation_id', 
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
            ->where('name', $name)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function edit($id)
    {
        // $patientRecords = Patient::where('name', $name);
        // return redirect()->to('/patient-record/'.$name);
        dd($id);
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
