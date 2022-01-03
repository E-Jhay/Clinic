<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="m-0 d-inline">Daily Treatment Record Form</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
        <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Insert Daily Treatment Record</h3>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="store()">
                                <div class="row mb-3">
                                  <div class="col-md-6">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" wire:model.lazy="name" id="name" placeholder="" value="" >
                                    @error('name')
                                      <div class="text-danger">
                                          {{$message}}
                                      </div>
                                    @enderror
                                  </div>
                                  <div class="col-md-3">
                                    <label for="designation_id">Designation</label>
                                    <select class="custom-select d-block w-100" wire:model.lazy="designation_id" id="designation_id" >
                                        <option value="">Select Designation</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('designation_id')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                  </div>
                                  <div class="col-md-3">
                                    <label for="course_id">Designation</label>
                                    <select class="custom-select d-block w-100" wire:model.lazy="course_id" id="designation_id" >
                                        <option value="">Select Course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                  </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Complaints</label>
                                            <textarea class="form-control" wire:model.lazy="complaints" rows="3" placeholder="Complaints ..."></textarea>
                                        </div>
                                    </div>
                                      @error('complaints')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                     @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Diagnosis</label>
                                            <textarea class="form-control" wire:model.lazy="diagnosis" rows="3" placeholder="Diagnosis ..."></textarea>
                                        </div>
                                    </div>
                                      @error('diagnosis')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                     @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Medical Service</label>
                                            <textarea class="form-control" wire:model.lazy="medical_service" rows="3" placeholder="Medical Service ..."></textarea>
                                        </div>
                                    </div>
                                      @error('medical_service')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                     @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Medicines Given <span class="text-muted">Separated by ", "</span></label>
                                            <textarea class="form-control" wire:model.lazy="medicines_given" rows="3" placeholder="Medicines ..."></textarea>
                                        </div>
                                    </div>
                                      @error('medicines_given')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                     @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                      <button type="submit" class="btn btn-primary float-right">Insert</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
      <!-- /.content -->
</div>