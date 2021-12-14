@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="m-0 d-inline">Dashboard</h1>
                {{-- <a href="{{route('orders.create')}}" class="btn btn-primary float-right">Add Request</a> --}}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
        
                      <div class="info-box-content">
                        <span class="info-box-text">No. of Patient</span>
                        <span class="info-box-number">{{$patient}}</span>
                        <span class="info-box-text">This Month</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.content -->
                <!-- ./col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Medicines Given</span>
                        <span class="info-box-number">{{$medicinesGiven}}</span>
                        <span class="info-box-text">This Month</span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
        
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
        
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Mostly Admitted</span>
                        <span class="info-box-number">{{$mostlyAdmitted ? $mostlyAdmitted[0]['designation']['name'] : 'No data'}}</span>
                        <span class="info-box-text">By Designation</span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            
                        <div class="info-box-content">
                            <span class="info-box-text">Number of Profiles</span>
                            <span class="info-box-number">{{$profiles}}</span>
                            <span class="info-box-text">All time</span>
                        </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-3 col-md-8">
              <div class="card">
                  <div class="card-header">
                      <div class="card-title">Illnesses This Month</div>
                  </div>
                  <div class="card-body">
                      <div id="monthlyIllness" style="height: 23rem;" ></div>
                  </div>
              </div>
          </div>
          <div class="col-12 col-sm-3 col-md-4">
              <div class="card">
                  <div class="card-header">
                      <div class="card-title">Top 5 Complaints This Month</div>
                  </div>
                  <div class="card-body">
                      <div id="topComplaints" style="height: 23rem;" ></div>
                  </div>
              </div>
          </div>
            <!-- /.col -->
        </div>
          <!-- /.row -->
    </section>
</div>
@endsection
@push('js')
<script>
    const Linechart = new Chartisan({
      el: '#monthlyIllness',
      url: "@chart('monthly_illness')",
      hooks: new ChartisanHooks()
    .beginAtZero()
    .borderColors(['#17a2b8'])
    .datasets([{ type: 'line', fill: false }, 'bar']),
    });

    const Piechart = new Chartisan({
      el: '#topComplaints',
      url: "@chart('top_complaints')",
      hooks: new ChartisanHooks()
        .datasets('doughnut')
        .pieColors(['#dc3545', '#007bff', '#28a745', '#ffc107', '#17a2b8'])
    });
</script>
@endpush

