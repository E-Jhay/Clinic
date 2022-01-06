<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="m-0 d-inline">{{ucfirst($first_name)}}'s BMI</h1>
                    <button wire:click="create()" class="d-inline btn btn-primary float-right">Insert New BMI</button>
                </div><!-- /.col -->
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{route('bmi')}}" class="btn btn-secondary">Go Back</a>
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
                                                    <th>Height</th>
                                                    <th>Weight</th>
                                                    <th>BMI</th>
                                                    <th>Classification</th>
                                                    <th>Month Year</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($bmis as $bmi)
                                                    <tr>
                                                        <td>{{$bmi->height}}</td>
                                                        <td>{{$bmi->weight}}</td>
                                                        <td>{{$bmi->bmi}}</td>
                                                        <td>{{$bmi->classification->name}}</td>
                                                        <td>{{$bmi->created_at->format('M Y')}}</td>
                                                        {{-- <td>{{$healthProfile->healthProfile}}</td> --}}
                                                        {{-- <td>{{$healthProfile->classification->name}}</td> --}}
                                                        <td class="text-center">
                                                            <button class="btn btn-success btn-sm" wire:click="edit('{{$bmi->id}}')"><i class="fas fa-edit"></i> Edit</button>
                                                            <button class="btn btn-danger btn-sm" wire:click="removehealthProfile({{$bmi->id}})"><i class="fas fa-trash"></i> Remove</button>

                                                            {{-- <button class="btn btn-success btn-sm" wire:click="viewRecords('{{$healthProfile->id}}')"><i class="fas fa-eye"></i> View Records</button> --}}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">No Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            </table>
                                            <p>
                                                Showing {{$bmis->firstItem()}} to {{$bmis->lastItem()}} out of {{$bmis->total()}} items.
                                            </p>
                                            {{ $bmis->links() }}
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