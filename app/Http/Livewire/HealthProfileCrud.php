<?php

namespace App\Http\Livewire;

use App\Models\Designation;
use App\Models\HealthProfile;
use Livewire\Component;

class HealthProfileCrud extends Component
{

    public $searchTerm;
    public $designations;
    public $isOpen = 0;
    public $name, $mobile_no, $age, $sex, $civil_status, $birthday, $address, $contact_person, $symptoms, $illness, $hospitalization, $allergies, $ps_history, $ob_history, $temperature, $pulse, $blood_pressure, $designation_id;


    public function render()
    {
        return view('livewire.health-profile-crud', [
            'healthProfiles' => $this->healthProfile,
        ]);
    }

    public function mount()
    {
        $this->designations = Designation::select('id', 'name')->get();
    }

        
    public function create()
    {
        $this->resetFields();
        $this->openModal();
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
        $this->mobile_no    = '';
        $this->age  = '';
        $this->sex  = '';
        $this->civil_status = '';
        $this->birthday = '';
        $this->address  = '';
        $this->contact_person   = '';
        $this->symptoms = '';
        $this->illness  = '';
        $this->hospitalization  = '';
        $this->allergies    = '';
        $this->ps_history   = '';
        $this->ob_history   = '';
        $this->temperature  = '';
        $this->pulse    = '';
        $this->blood_pressure   = '';
        $this->designation_id   = '';
    }


    public function store()
    {
        $this->validate([
            'name'=>'required',
            'mobile_no'=>['required', 'regex:/^9\d{9}$/'],
            'age'=>['required'],
            'sex'=>['required', 'in:male,female'],
            'civil_status'=>['required', 'in:single,married,widowed'],
            'birthday'=>['required', 'date', 'before:today'],
            'address'=>['required',  'max:255'],
            'contact_person'=>[ 'max:255'],
            'symptoms'=>[ 'max:255'],
            'illness'=>[ 'max:255'],
            'hospitalization'=>[ 'max:255'],
            'allergies'=>[ 'max:255'],
            'ps_history'=>[ 'max:255'],
            'ob_history'=>[ 'max:255'],
            'temperature'=>[ 'max:255'],
            'pulse'=>[ 'max:255'],
            'blood_pressure'=>[ 'max:255'],
            'designation_id'=>['required'],
        ]);

        // dd($this);
        
        try{
            HealthProfile::create([
                'name'              =>      $this->name,
                'mobile_no'         =>      $this->mobile_no,
                'age'               =>      $this->age,
                'sex'               =>      $this->sex,
                'civil_status'      =>      $this->civil_status,
                'birthday'          =>      $this->birthday,
                'address'           =>      $this->address,
                'contact_person'    =>      $this->contact_person,
                'symptoms'          =>      $this->symptoms,
                'illness'           =>      $this->illness,
                'hospitalization'   =>      $this->hospitalization,
                'allergies'         =>      $this->allergies,
                'ps_history'        =>      $this->ps_history,
                'ob_history'        =>      $this->ob_history,
                'temperature'       =>      $this->temperature,
                'pulse'             =>      $this->pulse,
                'blood_pressure'    =>      $this->blood_pressure,
                'designation_id'    =>      $this->designation_id,
            ]);
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Health Profile Inserted"
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong"
            ]);
        }

        $this->closeModal();
        $this->resetFields();
    }

    public function getHealthProfileProperty()
    {
        $searchTerm = '%'. $this->searchTerm .'%';
        return HealthProfile::with('designation')
        ->select('id', 'name', 'address', 'designation_id')
            ->when($searchTerm, function($q) use ($searchTerm){
                $q->where('name', 'like', $searchTerm)
                ->orWhere('address', 'like', $searchTerm);
            })
            ->get();
    }
}
