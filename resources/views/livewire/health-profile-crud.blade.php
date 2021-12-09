<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="m-0 d-inline">Health Profiles</h1>
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
                        <div class="card-title">
                            <ul class="nav nav-tabs">
                                {{-- @foreach ($statuses as $status)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $documentStatus == $status->id ? 'active' : null }}" wire:click.prevent="changeStatus({{$status->id}})" href="#">
                                            {{$status->name}}
                                        </a>
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                <a class="nav-link {{ $documentStatus == '' ? 'active' : null }}" wire:click.prevent="changeStatus('')" href="#">All</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="#">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">All</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content p-3">
                            <div class="tab-pane active" id="pending">
                                <div class="row">
                                    <div class="form-group col-3 mt-2">
                                        <input type="text"  class="form-control border-secondary" placeholder="Search..." wire:model="searchTerm"/>
                                    </div>
                                    <div class="form-group col-3 mt-2">
                                        <select class="form-control custom-select border-secondary">
                                            <option value="">All</option>
                                            <option value="">All</option>
                                            <option value="">All</option>
                                            <option value="">All</option>
                                            {{-- @foreach ($documentTypes as $documentType)
                                            <option value="{{$documentType->id}}">{{$documentType->name}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary">
                                            <option value="created_at">Date Created</option>
                                            <option value="name">Name</option>
                                            <option value="department_id">Department</option>
                                            <option value="ctr_no">Control Number</option> 
                                            <option value="or_no">OR Number</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary">
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <select class="form-control custom-select border-secondary">
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($healthProfiles as $healthProfileitem)
                                                <tr>
                                                    <td>{{$healthProfileitem->id}}</td>
                                                    <td>{{$healthProfileitem->name}}</td>
                                                    <td>{{$healthProfileitem->address}}</td>
                                                    <td>{{$healthProfileitem->designation->name}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                            {{-- <p>
                                                Showing {{$orders->firstItem()}} to {{$orders->lastItem()}} out of {{$orders->total()}} items.
                                            </p>
                                            {{ $orders->links() }} --}}
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