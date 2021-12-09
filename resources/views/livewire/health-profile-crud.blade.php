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
                    <h1 class="m-0 d-inline">{{$titlePage. " Health Profile"}}</h1>
                    <button wire:click="create()" class="d-inline btn btn-primary float-right">Add Profile</button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
        <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if($isOpen)
                <div class="row">
                    @include('livewire.health-profile-create')
                </div>
            @endif
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
                                            <option value="address">Address</option>
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
                                        {{-- @if ($documentStatus)
                                            <div class="form-group col-sm-12 mb-2">
                                                <button class="btn btn-primary" 
                                                @if ($documentStatus == 1)
                                                    wire:click.prevent="updatePending"
                                                @endif
                                                @if ($documentStatus == 2 || $documentStatus == 4)
                                                    wire:click.prevent="updateClaimable"
                                                @endif
                                                @if ($documentStatus == 3)
                                                    wire:click.prevent="updateReleased"
                                                @endif
                                                @if($bulkDisabled) disabled @endif>
                                                    @if ($documentStatus == 2)
                                                        Release
                                                    @elseif($documentStatus == 3)
                                                        Request for 2nd 
                                                    @elseif ($documentStatus == 4)
                                                        Extend
                                                    @else
                                                        Update
                                                    @endif
                                                    <span class="badge badge-warning right">
                                                        {{count($selectedItems)}}
                                                    </span></button>
                                            </div>
                                        @endif --}}
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Designation</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($healthProfiles as $healthProfile)
                                                <tr>
                                                    <td>{{$healthProfile->id}}</td>
                                                    <td>{{$healthProfile->name}}</td>
                                                    <td>{{$healthProfile->address}}</td>
                                                    <td>{{$healthProfile->designation->name}}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-success" wire:click="edit({{$healthProfile->id}})"><i class="fas fa-eye"></i> View</button>
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