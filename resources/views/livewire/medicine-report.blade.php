@push('css')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endpush
<div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1>@if ($option == 1)
            Monthly
        @elseif($option == 2)
            Quarterly
        @else
            Anually
        @endif Reports</h1>
        <div class="d-flex">
          <div class="input-group mt-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Year</div>
            </div>
            <input type="number" class="form-control col-sm-2" wire:model="year" placeholder="YYYY" min="2020" max="2100">
          </div>
          <div class="btn-group float-right">
            <button wire:click.prevent="changeOption(1)" class="btn btn-primary @if($option == 1) active @endif">Monthly</button>
            <button wire:click.prevent="changeOption(2)" class="btn btn-primary @if($option == 2) active @endif"">Quarterly</button>
            <button wire:click.prevent="changeOption(3)" class="btn btn-primary @if($option == 3) active @endif"">Anually</button>
          </div>
        </div>
        @if ($option == 1)
          <div class="input-group mt-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Month</div>
            </div>
            <select class="form-control custom-select col-sm-2" wire:model="month">
              <option value="" disabled>Select Month</option>
              <option value="01">January</option>
              <option value="02">February</option>
              <option value="03">March</option>
              <option value="04">April</option>
              <option value="05">May</option>
              <option value="06">June</option>
              <option value="07">July</option>
              <option value="08">August</option>
              <option value="09">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>
          </div>
        @elseif($option == 2)
          <div class="input-group mt-2">
            <div class="input-group-prepend">
              <div class="input-group-text">Quarter</div>
          </div>
          <select class="form-control custom-select col-sm-2" wire:model="quarter">
              <option value="" disabled>Select Quarter</option>
              <option value="1st">1st Quarter</option>
              <option value="2nd">2nd Quarter</option>
              <option value="3rd">3rd Quarter</option>
              <option value="4th">4th Quarter</option>
          </select>
        @endif
      </div><!-- /.container-fluid -->
    </div>
      <!-- /.content-header -->
  @if ($option == 1)
      @include('livewire.medicine-monthly-report')
  @endif
</div>



