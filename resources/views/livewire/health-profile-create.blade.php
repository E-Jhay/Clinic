<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Account</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="store()">
                <div class="row mb-3">
                  <div class="col-md-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" wire:model.lazy="name" id="name" placeholder="" value="" >
                    @error('name')
                      <div class="text-danger">
                          {{$message}}
                      </div>
                    @enderror
                  </div>
                  <div class="col-md-4">
                    <label>Mobile No</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                          <div class="input-group-text">+63</div>
                      </div>
                      <input type="number" wire:model.lazy="mobile_no" class="form-control" value="{{old('mobile_no')}}">
                    </div>
                    @error('mobile_no')
                      <div class="text-danger">
                          {{$message}}
                      </div>
                    @enderror
                  </div>
    
                  <div class="col-md-2">
                      <label for="age">Age</label>
                      <input type="number" class="form-control" wire:model.lazy="age" id="age" placeholder="" value="" >
                      @error('age')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                     @enderror
                  </div>
                  <div class="col-md-2">
                      <label for="sex">Sex</label>
                      <select class="custom-select d-block w-100" wire:model.lazy="sex" id="sex" >
                          <option value="">Select Sex</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                      </select>
                      @error('sex')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" wire:model.lazy="address" id="address" placeholder="1234 Main St" >
                      @error('address')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="col-md-3">
                      <label for="birthday">Birthday</label>
                      <input type="date" class="form-control" wire:model.lazy="birthday" id="birthday" placeholder="" value="" >
                      @error('birthday')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="col-md-3">
                      <label for="civil_status">Civil Status</label>
                      <select class="custom-select d-block w-100" wire:model.lazy="civil_status" id="civil_status" >
                          <option value="">Select Status</option>
                          <option value="single">Single</option>
                          <option value="married">Married</option>
                          <option value="widowed">Widowed</option>
                      </select>
                      @error('civil_status')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                      <label for="contact_person">Contact Person</label>
                      <input type="text" class="form-control" wire:model.lazy="contact_person" id="contact_person">
                      @error('contact_person')
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
                </div>
                <h4>Medical History</h4>
                <div class="row mb-3">
                  <div class="col-md-4">
                      <label for="symptoms">Present Symptoms <span class="text-muted">(Optional)</span></label>
                      <input type="text" wire:model.lazy="symptoms" class="form-control" id="symptoms">
                      @error('symptoms')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="col-md-4">
                      <label for="illness">Past Illness <span class="text-muted">(Optional)</span></label>
                      <input type="text" wire:model.lazy="illness" class="form-control" id="illness">
                      @error('illness')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="col-md-4">
                      <label for="hospitalization">History of Hospitalization <span class="text-muted">(Optional)</span></label>
                      <input type="text" wire:model.lazy="hospitalization" class="form-control" id="hospitalization">
                      @error('hospitalization')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-4">
                      <label for="allergies">Allergies <span class="text-muted">(Optional)</span></label>
                      <input type="text" wire:model.lazy="allergies" class="form-control" id="allergies">
                      @error('allergies')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="col-md-4">
                      <label for="ps_history">Personal or Social History <span class="text-muted">(Optional)</span></label>
                      <input type="text" wire:model.lazy="ps_history" class="form-control" id="ps_history">
                      @error('ps_history')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="col-md-4">
                      <label for="ob_history">Gynecological History <span class="text-muted">(Optional)</span></label>
                      <input type="text" wire:model.lazy="ob_history" class="form-control" id="ob_history">
                      @error('ob_history')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                </div>
    
                <div class="row mb-3">
                  <div class="col-md-4">
                      <label for="temperature">Temperature <span class="text-muted">(Optional)</span></label>
                      <input type="number" wire:model.lazy="temperature" class="form-control" id="temperature">
                      @error('temperature')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="col-md-4">
                      <label for="pulse">Pulse <span class="text-muted">(Optional)</span></label>
                      <input type="number" wire:model.lazy="pulse" class="form-control" id="pulse">
                      @error('pulse')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="col-md-4">
                      <label for="blood_pressure">Blood Pressure <span class="text-muted">(Optional)</span></label>
                      <input type="text" wire:model.lazy="blood_pressure" class="form-control" id="blood_pressure">
                      @error('blood_pressure')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button wire:click.prevent="closeModal" class="btn btn-warning float-right">Cancel</button>
                    </div>
                </div>
              </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>