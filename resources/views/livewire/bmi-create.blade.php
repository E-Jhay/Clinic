<div class="col-md-12">
  <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">{{$updateMode ? 'Update BMI' : 'Insert BMI'}}</h3>
      </div>
      <div class="card-body">
          <form wire:submit.prevent="{{$updateMode ? 'update' : 'store'}}">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" wire:model.lazy="name" id="name" placeholder="" value="" >
                  @error('name')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="height">Height <span class="text-muted">(in kilogram)</span></label>
                  <input type="number" step=".01" class="form-control" wire:model.lazy="height" id="height" placeholder="" value="" >
                  @error('height')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="weight">Weight <span class="text-muted">(in meters)</span></label>
                  <input type="number" class="form-control" wire:model.lazy="weight" id="weight" placeholder="" value="" >
                  @error('weight')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row">
                  <div class="form-group col-12">
                    <button type="submit" class="btn btn-primary float-right">{{$updateMode ? 'Update' : 'Insert'}}</button>
                    <button wire:click.prevent="closeModal" class="btn btn-warning">Cancel</button>
                  </div>
              </div>
          </form>
      </div>
      <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>