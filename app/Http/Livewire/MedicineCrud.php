<?php

namespace App\Http\Livewire;

use App\Models\Medicine;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

use Livewire\Component;

class MedicineCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $isOpen = 0;
    public $searchTerm;
    public $sortBy = 'created_at';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $name, $stock, $description, $expiration_date;

    protected $listeners = [
        'addStockConfirmed' => 'addStockConfirmed',
        'removeStockConfirmed' => 'removeStockConfirmed',

    ];

    public function render()
    {
        return view('livewire.medicine-crud',[
            'medicines' =>  $this->medicine,
        ]);
    }

    public function getMedicineProperty()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        return Medicine::select('id', 'name', 'description', 'stock', DB::raw('SUM(stock) as total'),)
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
        $this->expiration_date ='';
    }

    public function store()
    {
        $this->validate([
            'name'  =>  'required',
            'stock'  =>  ['required', 'gt:0'],
            'description'  =>  ['string'],
            'expiration_date'  =>  ['required', 'date', 'after:today'],
        ]);
        
        try{
            // $existingMedicine = Medicine::where('name', strtolower($this->name))->first();
            // if($existingMedicine){
            //     $existingMedicine->update([
            //         'name'  =>  strtolower($this->name),
            //         'code'  =>  preg_replace('/\s+/', '', $this->name),
            //         'stock'  =>  $existingMedicine->stock + $this->stock,
            //         'description'  =>  $this->description,
            //         'expiration_day'  =>  $this->expiration_date,
            //     ]);
            // }
            // else{
            //     Medicine::create([
            //         'name'  =>  strtolower($this->name),
            //         'code'  =>  preg_replace('/\s+/', '', $this->name),
            //         'stock'  =>  $this->stock,
            //         'description'  =>  $this->description,
            //         'expiration_day'  =>  $this->expiration_date,
            //     ]);
            // }
            Medicine::create([
                'name'  =>  strtolower($this->name),
                'code'  =>  strtolower(preg_replace('/\s+/', '', $this->name)),
                'stock'  =>  $this->stock,
                'description'  =>  $this->description,
                'expiration_day'  =>  $this->expiration_date,
            ]);
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'New Medicine Added'
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
            $existingMedicine = Medicine::findOrFail($id);
                if($existingMedicine){
                    $existingMedicine->update([
                        'stock'  =>  $existingMedicine->stock + $quantity,
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
            $existingMedicine = Medicine::findOrFail($id);
                if($existingMedicine){
                    if($existingMedicine->stock >= $quantity){
                        $existingMedicine->update([
                            'stock'  =>  $existingMedicine->stock - $quantity,
                        ]);
                    }
                    else{
                        $existingMedicine->update([
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
