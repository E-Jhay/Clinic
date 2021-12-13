@push('css')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endpush
<div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1>Medicine Given Anually Reports</h1>
        <div class="d-flex">
          <div class="input-group mt-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Year</div>
            </div>
            <input type="number" class="form-control col-sm-2" wire:model="year" placeholder="YYYY" min="2020" max="2100">
          </div>
          <div class="btn-group float-right">
            <button class="btn btn-primary">
              <a class="text-white" href="{{route('medicine-monthly-report')}}">Monthly</a>
            </button>
            <button class="btn btn-primary">
              <a class="text-white" href="{{route('medicine-quarterly-report')}}">Quarterly</a>
            </button>
            <button class="btn btn-primary active">
              <a class="text-white" href="{{route('medicine-anually-report')}}">Anually</a>
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
      <!-- /.content-header -->
      
  <section class="content">
    <div class="container-fluid">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12 text-center">
                <h5>
                  PANGASINAN STATE UNIVERSITY
                </h5>
                <h5>
                  ALAMINOS CITY CAMPUS
                </h5>
                <h5>
                  ALAMINOS CITY PANGASINAN
                </h5>
                <h5>
                  MEDICAL-DENTAL UNIT
                </h5>
                <h5>{{"Year ". $year}}</h5>
              </div>
              <!-- /.col -->
            </div>
            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Medicines Given</th>
                            @foreach ($designations as $designation)
                                <th class="text-center">{{$designation->name}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report as $medicine_name => $values)
                            <tr>
                                <td>{{ucfirst($medicine_name)}}</td>
                                @foreach ($designations as $designation)
                                    <td class="text-center">{{$report[$medicine_name][$designation->id]['count'] ?? '0'}}</td>
                                @endforeach
                                {{-- <td class="text-center">{{$totalCountPerDocs[$document] ?? '0'}}</td> --}}
                            </tr>
                        @endforeach
                        <tr>
                            <td><strong>No. of Medicines Given</strong></td>
                            @foreach ($designations as $designation)
                                <td class="text-center">{{$totalCountPerDesignation[$designation->id] ?? '0'}}</td>
                            @endforeach
                            {{-- <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">Total</td>
                            <td class="text-center">{{$totalCount}}</td> --}}
                        </tr>
                        <tr>
                            <td><strong>Total No. of Medicine</strong></td>
                            <td class="text-center">{{$totalCount}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between prepared-by mt-5">
                  <div>
                      <strong>Prepared By: {{Auth::user()->name}}</strong>
                      <p><strong>Campus Nurse</strong></p>
                  </div>
                  <div class="">
                      <strong>Noted By: ELMER C. DIOCARES, Ma.Ed</strong>
                      <p><strong>Coordinator, Student Services</strong></p>
                  </div>
                </div>
                <div class="d-flex justify-content-between prepared-by mt-3">
                  <div>
                      <strong>Recommending Approval: RENE D, CACHO, MAVTE</strong>
                      <p><strong>Administrative Officer,</strong></p>
                  </div>
                  <div class="">
                      <strong>Approved By: RENATO E. SALCEDO, Ph.D</strong>
                      <p><strong>Campus Executive Director</strong></p>
                  </div>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
              <button type="button" wire:click.prevent="export('xlsx')" wire:loading.attr="disabled" class="btn btn-success float-right">
                  <i class="fas fa-file-excel"></i> Excel
              </button>
              <button onclick="print()"class="btn btn-primary float-right" style="margin-right: 5px;">
                <i class="fas fa-print"></i> Print
              </button>
            </div>
          </div>
        </div>
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
    </div>

</section>
</div>



