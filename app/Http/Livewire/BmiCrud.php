<?php

namespace App\Http\Livewire;

use App\Models\Bmi;
use App\Models\BmiClassification;
use App\Models\HealthProfile;
use Livewire\Component;
use Livewire\WithPagination;

class BmiCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $isOpen = 0;
    public $updateMode = 0;
    public $searchTerm;
    public $sortDirection = 'desc';
    public $sortBy = 'created_at';
    public $sortClassification;
    public $perPage = 10;
    public $name, $height, $weight;

    protected $listeners = [
        'removeBmiConfirmed' => 'removeBmiConfirmed',

    ];

    public function render()
    {
        return view('livewire.bmi-crud', [
            'bmis'    =>  $this->bmis,
            'bmi_classifications'    =>  BmiClassification::select('id', 'name')->get(),
        ]);
    }

    public function getBmisProperty()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $sortClassification = $this->sortClassification;
        return Bmi::with('classification')
                ->select('id', 'name', 'height', 'weight', 'bmi', 'bmi_classification_id')
                ->when($sortClassification, function($q) use ($sortClassification, $searchTerm){
                    $q->where('bmi_classification_id', $sortClassification)
                        ->where('name', 'like', $searchTerm);
                }, function($q) use ($searchTerm){
                        $q->where('name', 'like', $searchTerm);
                    })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function create()
    {
        $this->updateMode = false;
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
        $this->height ='';
        $this->weight ='';
    }

    public function store()
    {
        $this->validate([
            'name'  =>  'required',
            'height'  =>  ['required', 'lt:4'],
            'weight'  =>  ['required'],
        ]);
        
        try{

            $bmi = $this->weight / ($this->height*$this->height);
            $classification = "";
            if($bmi < 18.5)
                $classification = 1;
            elseif($bmi >= 18.5 && $bmi <= 24.9)
                $classification = 2;
            elseif($bmi >= 25.0 && $bmi <= 29.9)
                $classification = 3;
            else
                $classification = 4;
            
            // dd($bmi. " ". $classification);
            Bmi::create([
                'name' => $this->name,
                'height' => $this->height,
                'weight' => $this->weight,
                'bmi' => $bmi,
                'bmi_classification_id' => $classification,
            ]);

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'BMI Inserted'
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
        $this->updateMode = true;
        $bmi = Bmi::findOrFail($id);
        $this->name = $bmi->name;
        $this->height = $bmi->height;
        $this->weight = $bmi->weight;
        $this->bmiId = $id;
        $this->emit('gotoTop');
        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'name'  =>  'required',
            'height'  =>  ['required', 'lt:4'],
            'weight'  =>  ['required'],
        ]);

        try {

            $bmi = $this->weight / ($this->height*$this->height);
            $classification = "";
            if($bmi < 18.5)
                $classification = 1;
            elseif($bmi >= 18.5 && $bmi <= 24.9)
                $classification = 2;
            elseif($bmi >= 25.0 && $bmi <= 29.9)
                $classification = 3;
            else
                $classification = 4;

            Bmi::where('id', $this->bmiId)
                ->update([
                    'name' => $this->name,
                    'height' => $this->height,
                    'weight' => $this->weight,
                    'bmi' => $bmi,
                    'bmi_classification_id' => $classification,
                ]);

            $this->dispatchBrowserEvent('alert',[
                'type'  =>  'success',
                'message'   =>  'BMI Updated Successfully'
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong!!"
            ]);
        }
        
        $this->updateMode = false;
        $this->closeModal();
        $this->resetFields();
        // dd($this->equipmentId);
    }

    public function removeBmi($id)
    {
        $this->dispatchBrowserEvent('swal:removeBmi',[
            'type'  =>  'warning',
            'title' =>  'Are you sure you want to remove BMI?',
            'text'  =>  '',
            'id'    =>  $id,
        ]);
    }
    public function removeBmiConfirmed($id)
    {
        try{
            
            Bmi::findOrFail($id)
                ->delete();

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'Bmi Removed'
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong"
            ]);
        }
    }
}
