<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Medicine</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="update()">
                <div class="row mb-3">
                  <div class="col-md-7">
                    <label for="name">Medicine Name</label>
                    <input type="text" class="form-control" wire:model.lazy="name" id="name" placeholder="" value="" >
                    @error('name')
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
                            <label>Description</label>
                            <textarea class="form-control" wire:model.lazy="description" rows="3" placeholder="Description ..."></textarea>
                        </div>
                    </div>
                      @error('description')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                     @enderror
                </div>
                <div class="row">
                    <div class="form-group col-12">
                      <button type="submit" class="btn btn-primary float-right">Update</button>
                      <button wire:click.prevent="closeModal" class="btn btn-warning">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>