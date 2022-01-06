<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Designation;
use App\Models\HealthProfile;
use Livewire\WithPagination;
use Livewire\Component;

class HealthProfileCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $buttonText = "Save";
    public $sortDirection = 'asc';
    public $sortBy = 'created_at';
    public $sortDesignation;
    public $sortCourse;
    public $perPage = 10;
    public $designations;
    public $titlePage = "";
    public $designationStatus = "";
    public $isOpen = 0;
    public $healthProfileId;
    public $first_name, $middle_name, $last_name, $mobile_no, $age, $sex, $civil_status, $birthday, $address, $contact_person, $symptoms, $illness, $hospitalization, $allergies, $ps_history, $ob_history, $temperature, $pulse, $blood_pressure, $designation_id, $course_id;


    public function render()
    {
        return view('livewire.health-profile-crud', [
            'healthProfiles'    =>  $this->healthProfile,
            'designations'      =>  Designation::all(),
            'courses'           =>  Course::all(),
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
        $this->first_name = '';
        $this->middle_name = '';
        $this->last_name = '';
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
        $this->course_id   = '';
    }


    public function store()
    {
        $this->validate([
            'first_name'=>'required',
            'last_name'=>'required',
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
            if($this->designation_id != 1)
            {
                $this->course_id = 7;
            }
            HealthProfile::updateOrCreate(['id' => $this->healthProfileId], [
                'first_name'        =>      $this->first_name,
                'middle_name'       =>      $this->middle_name,
                'last_name'         =>      $this->last_name,
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
                'course_id'         =>      $this->course_id,
            ]);
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=> $this->healthProfileId ? 'Health Profile Updated' : 'Health Profile Inserted'
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

    public function edit($id)
    {
        $this->buttonText = "Update";
        $healthProfile = HealthProfile::findOrFail($id);
        $this->first_name           = $healthProfile->first_name;
        $this->middle_name          = $healthProfile->middle_name;
        $this->last_name            = $healthProfile->last_name;
        $this->mobile_no            = $healthProfile->mobile_no;
        $this->age                  = $healthProfile->age;
        $this->sex                  = $healthProfile->sex;
        $this->civil_status         = $healthProfile->civil_status;
        $this->birthday             = $healthProfile->birthday;
        $this->address              = $healthProfile->address;
        $this->contact_person       = $healthProfile->contact_person;
        $this->symptoms             = $healthProfile->symptoms;
        $this->illness              = $healthProfile->illness;
        $this->hospitalization      = $healthProfile->hospitalization;
        $this->allergies            = $healthProfile->allergies;
        $this->ps_history           = $healthProfile->ps_history;
        $this->ob_history           = $healthProfile->ob_history;
        $this->temperature          = $healthProfile->temperature;
        $this->pulse                = $healthProfile->pulse;
        $this->blood_pressure       = $healthProfile->blood_pressure;
        $this->designation_id       = $healthProfile->designation_id;
        $this->course_id       = $healthProfile->course_id;
        $this->healthProfileId      = $id;
        $this->emit('gotoTop');
        $this->openModal();
    }

    public function getHealthProfileProperty()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $sortDesignation = $this->sortDesignation;
        if($this->sortDirection == 2 || $this->sortDirection == 3){
            $this->sortCourse == 7;
        }
        $sortCourse = $this->sortCourse;
        return HealthProfile::with('designation')
            ->select('id', 'first_name', 'middle_name', 'last_name', 'address', 'designation_id', 'course_id')
            ->when($sortDesignation, function($q) use ($sortDesignation, $searchTerm){
                $q->where('designation_id', $sortDesignation)
                    ->where('first_name', 'like', $searchTerm)
                    ->orWhere('middle_name', 'like', $searchTerm)
                    ->orWhere('last_name', 'like', $searchTerm);
                }, function($q) use ($searchTerm){
                    $q->where('first_name', 'like', $searchTerm)
                    ->orWhere('middle_name', 'like', $searchTerm)
                    ->orWhere('last_name', 'like', $searchTerm);
                })
            ->when($sortCourse, function($q) use ($sortCourse, $searchTerm){
                $q->where('course_id', $sortCourse)
                    ->where('first_name', 'like', $searchTerm)
                    ->orWhere('middle_name', 'like', $searchTerm)
                    ->orWhere('last_name', 'like', $searchTerm);
                }, function($q) use ($searchTerm){
                    $q->where('first_name', 'like', $searchTerm)
                    ->orWhere('middle_name', 'like', $searchTerm)
                    ->orWhere('last_name', 'like', $searchTerm);
                })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function changeStatus($designationId)
    {
        $designations = Designation::select('id', 'name')->get();
        foreach($designations as $designation){
            if($designationId == $designation['id'])
                $this->titlePage = $designation['name'];
            elseif($designationId == '')
                $this->titlePage = "";

        }
        $this->resetPage();
        return $this->designationStatus = $designationId;
    }
}
