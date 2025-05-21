@extends('website.layouts.app', ['title' => 'Dashboard'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          </ol>
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
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $kelasActivated }}</h3>

              <p>Departments</p>
            </div>
            <div class="icon">
              <i class="fas fa-star"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>-</h3>

              <p>Positions</p>
            </div>
            <div class="icon">
              <i class="fas fa-flag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $siswaActivated }}</h3>

              <p>Siswa</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $deviceActivated }}</h3>

              <p>Devices</p>
            </div>
            <div class="icon">
              <i class="fas fa-chart-pie"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{ $clockInToday }}</h3>

              <p>Clock In Today</p>
            </div>
            <div class="icon">
              <i class="fas fa-clock"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $clockOutToday }}</h3>

              <p>Clock Out Today</p>
            </div>
            <div class="icon">
              <i class="fas fa-clock"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Number Of Staff By Department</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="staffByDepartment" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
        </div>

        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Number Of Staff By Position</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="staffByPosition" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('scripts')
  <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
  <script type="text/javascript">
      var staffByDepartmentCanvas = $('#staffByDepartment').get(0).getContext('2d')
      var donutData        = {
        labels: @json($chartKelasLabel),
        datasets: [
          {
            data: @json($chartKelasCount),
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
          }
        ]
      }
      var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(siswaByKelasCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      })
  </script>
@endpush