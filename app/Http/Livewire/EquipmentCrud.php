<?php

namespace App\Http\Livewire;

use App\Models\Equipment;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

use Livewire\Component;

class EquipmentCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $isOpen = 0;
    public $searchTerm;
    public $sortBy = 'created_at';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $name, $stock, $description;

    protected $listeners = [
        'addStockConfirmed' => 'addStockConfirmed',
        'removeStockConfirmed' => 'removeStockConfirmed',

    ];

    public function render()
    {
        return view('livewire.equipment-crud',[
            'equipments' =>  $this->equipment,
        ]);
    }

    public function getequipmentProperty()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        return Equipment::select('id', 'name', 'description', 'stock', DB::raw('SUM(stock) as total'),)
            ->when($searchTerm, function($q) use ($searchTerm){
                $q->where('name', 'like', $searchTerm);
            })
            ->groupBy('name')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
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
        $this->stock ='';
        $this->description ='';
    }

    public function store()
    {
        $this->validate([
            'name'  =>  'required',
            'stock'  =>  ['required'],
            'description'  =>  ['string'],
        ]);
        
        try{
            $existingEquipment = Equipment::where('name', strtolower($this->name))->first();
            if($existingEquipment){
                $existingEquipment->update([
                    'name'  =>  strtolower($this->name),
                    'stock'  =>  $existingEquipment->stock + $this->stock,
                    'description'  =>  $this->description,
                ]);
            }
            else{
                Equipment::create([
                    'name'  =>  strtolower($this->name),
                    'stock'  =>  $this->stock,
                    'description'  =>  $this->description,
                ]);
            }

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'New Equipment Added'
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

    public function addStock($id)
    {
        $this->dispatchBrowserEvent('swal:addStock',[
            'type'  =>  'warning',
            'title' =>  'Add Stock on the selected Item',
            'text'  =>  '',
            'id'    =>  $id,
        ]);
    }
    public function addStockConfirmed($quantity, $id)
    {
        try{
            $existingEquipment = Equipment::findOrFail($id);
                if($existingEquipment){
                    $existingEquipment->update([
                        'stock'  =>  $existingEquipment->stock + $quantity,
                    ]);
                }
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'Stock Added'
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong"
            ]);
        }
    }
    public function removeStock($id)
    {
        $this->dispatchBrowserEvent('swal:removeStock',[
            'type'  =>  'warning',
            'title' =>  'Remove Stock on the selected Item',
            'text'  =>  '',
            'id'    =>  $id,
        ]);
    }
    public function removeStockConfirmed($quantity, $id)
    {
        try{
            $existingEquipment = Equipment::findOrFail($id);
                if($existingEquipment){
                    if($existingEquipment->stock >= $quantity){
                        $existingEquipment->update([
                            'stock'  =>  $existingEquipment->stock - $quantity,
                        ]);
                    }
                    else{
                        $existingEquipment->update([
                            'stock'  =>  0,
                        ]);
                    }
                }
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'Stock Removed'
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong"
            ]);
        }
    }
}
