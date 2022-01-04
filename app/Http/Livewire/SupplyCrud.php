<?php

namespace App\Http\Livewire;

use App\Models\Supply;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

use Livewire\Component;

class SupplyCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $isOpen = 0;
    public $searchTerm;
    public $sortBy = 'created_at';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $updateMode = 0;
    public $supplyId;
    public $name, $stock, $description;

    protected $listeners = [
        'addStockConfirmed' => 'addStockConfirmed',
        'removeStockConfirmed' => 'removeStockConfirmed',

    ];

    public function render()
    {
        return view('livewire.supply-crud',[
            'supplies' =>  $this->supply,
        ]);
    }

    public function getSupplyProperty()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        return Supply::select('id', 'name', 'description', 'stock', DB::raw('SUM(stock) as total'),)
            ->when($searchTerm, function($q) use ($searchTerm){
                $q->where('name', 'like', $searchTerm);
            })
            ->groupBy('name')
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
        $this->stock ='';
        $this->description ='';
    }

    public function store()
    {
        $this->validate([
            'name'  =>  'required',
            'stock'  =>  ['required', 'gt:0'],
            'description'  =>  ['string'],
        ]);
        
        try{
            $existingSupply = Supply::where('name', strtolower($this->name))->first();
            if($existingSupply){
                $existingSupply->update([
                    'name'  =>  strtolower($this->name),
                    'stock'  =>  $existingSupply->stock + $this->stock,
                    'description'  =>  $this->description,
                ]);
            }
            else{
                Supply::create([
                    'name'  =>  strtolower($this->name),
                    'stock'  =>  $this->stock,
                    'description'  =>  $this->description,
                ]);
            }

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'New supply Added'
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

    public function editSupply($id)
    {
        $this->updateMode = true;
        $supply = Supply::findOrFail($id);
        $this->name = $supply->name;
        $this->description = $supply->description;
        $this->supplyId = $id;
        $this->emit('gotoTop');
        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'name'  =>  'required',
            'description'  =>  ['string'],
        ]);

        try {
            Supply::where('id', $this->supplyId)
                ->update([
                'name'  =>  $this->name,
                'description'  =>  $this->description,
            ]);

            $this->dispatchBrowserEvent('alert',[
                'type'  =>  'success',
                'message'   =>  'Supply Updated Successfully'
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
            $existingSupply = Supply::findOrFail($id);
                if($existingSupply){
                    $existingSupply->update([
                        'stock'  =>  $existingSupply->stock + $quantity,
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
            $existingSupply = Supply::findOrFail($id);
                if($existingSupply){
                    if($existingSupply->stock >= $quantity){
                        $existingSupply->update([
                            'stock'  =>  $existingSupply->stock - $quantity,
                        ]);
                    }
                    else{
                        $existingSupply->update([
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
