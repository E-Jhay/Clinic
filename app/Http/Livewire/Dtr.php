<?php

namespace App\Http\Livewire;

use App\Models\Designation;
use App\Models\Medicine;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dtr extends Component
{
    public $name, $designation_id, $complaints, $diagnosis, $medical_service, $medicines_given;


    public function render()
    {
        return view('livewire.dtr', [
            'designations'      =>  Designation::all(),
        ]);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->designation_id = '';
        $this->complaints = '';
        $this->diagnosis = '';
        $this->medical_service = '';
        $this->medicines_given = '';
    }


    public function store()
    {
        // $this->validate([
        //     'name'              =>  'required',
        //     'designation_id'       =>  'required',
        //     'complaints'        =>  'required',
        //     'diagnosis'         =>  'required',
        //     'medical_service'   =>  'required',
        //     'medicines_given'   =>  'required',
        // ]);
            
        try{
            Patient::create([
                'name'              =>      strtolower($this->name),
                'designation_id'    =>      $this->designation_id,
                'complaints'        =>      strtolower($this->complaints),
                'diagnosis'         =>      strtolower($this->diagnosis),
                'medical_service'   =>      strtolower($this->medical_service),
                'medicines_given'   =>      strtolower($this->medicines_given),
            ]);

            // dd($this);
            $medicine_given_lists = explode(",", preg_replace('/\s+/', '', $this->medicines_given));
            foreach($medicine_given_lists as $medicine_given_list){
                $existingMedicine = Medicine::where('name', 'like', '%'.$medicine_given_list.'%')->first();

                if($existingMedicine){
                    if($existingMedicine->stock > 0){
                        $existingMedicine->update([
                            'stock' =>  $existingMedicine->stock - 1,
                        ]);
                    }
                }
            }

            $this->resetFields();
            // dd($medicine_given_list);
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'DTR Inserted'
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong"
            ]);
        }
    }
}
