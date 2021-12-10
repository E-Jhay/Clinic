@push('css')
<style>
    .nav-tabs .nav-link{
        color: #000;
    }
    .nav-tabs .nav-link.active{
        color: #fff;
        background-color: #278af5;
        border-color: trasparent;
    }
</style>
@endpush
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="m-0 d-inline">Patient</h1>
                    <button wire:click="create()" class="d-inline btn btn-primary float-right">Insert DTR</button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
        <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="tab-content p-3">
                            <div class="tab-pane active" id="pending">
                                <div class="row">
                                    <div class="form-group col-3 mt-2">
                                        <input type="text"  class="form-control border-secondary" placeholder="Search..." wire:model="searchTerm"/>
                                    </div>
                                    <div class="form-group col-3 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="sortDesignation">
                                            <option value="">All</option>
                                            @foreach ($designations as $designation)
                                                <option value="{{$designation->id}}">{{$designation->name}}</option>
                                            @endforeach
                                        </select>
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
                                                    <th>Diagnosis</th>
                                                    <th>Designation</th>
                                                    <th style="width: 150px" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($patients as $patient)
                                                <tr>
                                                    <td>{{ucfirst($patient->name)." ".$patient->id}}</td>
                                                    <td>{{ucfirst($patient->diagnosis)}}</td>
                                                    <td>{{$patient->designation->name}}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-success btn-sm" wire:click="viewRecords('{{$patient->name}}')"><i class="fas fa-eye"></i> View Records</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                            <p>
                                                Showing {{$patients->firstItem()}} to {{$patients->lastItem()}} out of {{$patients->total()}} items.
                                            </p>
                                            {{ $patients->links() }}
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