<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="m-0 d-inline">Faculty's BMI</h1>
                    {{-- <button wire:click="create()" class="d-inline btn btn-primary float-right">Insert healthProfile</button> --}}
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
                    @include('livewire.bmi-create')
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
                                        <select class="form-control custom-select border-secondary" wire:model="sortClassification">
                                            <option value="">Classification (all)</option>
                                            @foreach ($bmi_classifications as $bmi_classification)
                                                <option value="{{$bmi_classification->id}}">{{$bmi_classification->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary" wire:model="sortBy">
                                            <option value="created_at">Created At</option>
                                            <option value="name">Name</option>
                                            <option value="height">Height</option>
                                            <option value="weight">Weight</option>
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
                                                    <th>Age</th>
                                                    <th>Sex</th>
                                                    <th>Address</th>
                                                    {{-- <th>healthProfile</th> --}}
                                                    {{-- <th>Classification</th> --}}
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($healthProfiles as $healthProfile)
                                                <tr>
                                                    <td>{{ucfirst($healthProfile->first_name ." ". $healthProfile->middle_name ." ". $healthProfile->last_name)}}</td>
                                                    <td>{{$healthProfile->age}}</td>
                                                    <td>{{ucfirst($healthProfile->sex)}}</td>
                                                    <td>{{ucfirst($healthProfile->address)}}</td>
                                                    {{-- <td>{{$healthProfile->healthProfile}}</td> --}}
                                                    {{-- <td>{{$healthProfile->classification->name}}</td> --}}
                                                    <td class="text-center">
                                                        {{-- <button class="btn btn-success btn-sm" wire:click="edit('{{$healthProfile->id}}')"><i class="fas fa-edit"></i> Edit</button>
                                                        <button class="btn btn-danger btn-sm" wire:click="removehealthProfile({{$healthProfile->id}})"><i class="fas fa-trash"></i> Remove</button> --}}

                                                        <button class="btn btn-success btn-sm" wire:click="viewRecords('{{$healthProfile->id}}')"><i class="fas fa-eye"></i> View Records</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                            <p>
                                                Showing {{$healthProfiles->firstItem()}} to {{$healthProfiles->lastItem()}} out of {{$healthProfiles->total()}} items.
                                            </p>
                                            {{ $healthProfiles->links() }}
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