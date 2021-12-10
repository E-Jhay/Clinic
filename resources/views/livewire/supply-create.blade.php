<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Supply</h3>
        </div>
        <div class="card-body" style="padding-inline: 14rem">
            <form wire:submit.prevent="store()">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="name">Supply Name</label>
                    <input type="text" class="form-control" wire:model.lazy="name" id="name" placeholder="" value="" >
                    @error('name')
                      <div class="text-danger">
                          {{$message}}
                      </div>
                    @enderror
                  </div>
                  <div class="col-md-4">
                    <label>Quantity</label>
                      <input type="number" wire:model.lazy="stock" class="form-control" value="{{old('stock')}}">
                    @error('stock')
                      <div class="text-danger">
                          {{$message}}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
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
                      <button type="submit" class="btn btn-primary float-right">Insert</button>
                      <button wire:click.prevent="closeModal" class="btn btn-warning">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>