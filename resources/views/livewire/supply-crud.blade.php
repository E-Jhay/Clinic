<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="m-0 d-inline">Supplies</h1>
                    <button wire:click="create()" class="d-inline btn btn-primary float-right">Store New Supply</button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
        <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if($isOpen)
                    @include('livewire.supply-create')
                @endif
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="tab-content p-3">
                            <div class="tab-pane active" id="pending">
                                <div class="row">
                                    <div class="form-group col-3 mt-2">
                                        <input type="text"  class="form-control border-secondary" placeholder="Search..." wire:model="searchTerm"/>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="sortBy">
                                            <option value="created_at">Date Created</option>
                                            <option value="name">Name</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2 mt-2" wire:model="sortDirection">
                                        <select class="form-control custom-select border-secondary">
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="perPage">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="250">250</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th style="width: 5rem">Stock</th>
                                                    <th style="width: 16rem" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($supplies as $supply)
                                                <tr>
                                                    <td>{{ucfirst($supply->name)}}</td>
                                                    <td>{{$supply->description}}</td>
                                                    @if ($supply->total <= 0)
                                                        <td>
                                                            <div class="bg-danger rounded px-1">Out of Stock</div>
                                                        </td>
                                                    @else
                                                        <td class="text-center">{{$supply->total}}</td>
                                                    @endif
                                                    <td class="text-center">
                                                        <button class="btn btn-success btn-sm" wire:click="addStock({{$supply->id}})"><i class="fas fa-eye"></i> Add Stock</button>
                                                        <button class="btn btn-warning btn-sm" wire:click="removeStock({{$supply->id}})"><i class="fas fa-eye"></i> Remove Stock</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                            <p>
                                                Showing {{$supplies->firstItem()}} to {{$supplies->lastItem()}} out of {{$supplies->total()}} items.
                                            </p>
                                            {{ $supplies->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <!-- /.content -->
</div>