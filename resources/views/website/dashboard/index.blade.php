@extends('website.layouts.app', ['title' => 'Dashboard'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      @if(!session()->has('welcome_alert_dismissed'))
      <div class="alert alert-light alert-dismissible fade show" role="alert">
        Selamat Datang, <strong>@auth{{ Auth::user()->name }}@endauth</strong>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="dismissWelcomeAlert()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif

      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
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
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-primary">
            <div class="inner">
              <p>Jumlah Siswa</p>
              <h3>{{ $siswaActivated }}</h3>
            </div>
            <div class="icon">
              <i class="fas fa-user-graduate"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-success">
            <div class="inner">
              <p>Jumlah Guru</p>
              <h3>{{ $guruActivated }}</h3>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-info">
            <div class="inner">
              <p>Jumlah Kelas</p>
              <h3>{{ $kelasActivated }}</h3>
            </div>
            <div class="icon">
              <i class="fas fa-landmark"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </div>
  </section>
        
  <section class="content">
    <div class="container-fluid">
      <div class="card card-outline card-secondary m-auto d-block">
          <p class="px-4 pt-3">Rekap Absensi Siswa Sekolah Prestasi Prima tanggal <span class="font-weight-bold">{{ $today }}</span>.</p>
      </div>
    </div>
  </section>
  <br>
          <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-6 col-6">
          <!-- small card -->
          <div class="small-box bg-primary">
            <div class="inner">
              <p>Jumlah Siswa Absen Masuk Hari Ini</p>
              <h3>{{ $clockInToday }}</h3>
            </div>
            <div class="icon">
              <i class="fas fa-clock"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
          <!-- small card -->
          <div class="small-box bg-danger">
            <div class="inner">
              <p>Jumlah Siswa Absen Pulang Hari Ini</p>
              <h3>{{ $clockOutToday }}</h3>
            </div>
            <div class="icon">
              <i class="fas fa-clock"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $siswaHadir }}</h3>

              <p>Siswa Hadir</p>
            </div>
            <div class="icon">
              <i class="fas fa-smile-beam"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $siswaTerlambat }}</h3>

              <p>Siswa Terlambat</p>
            </div>
            <div class="icon">
              <i class="fas fa-meh"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <!-- small card -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $siswaTidakHadir }}</h3>

              <p>Siswa Tidak Hadir</p>
            </div>
            <div class="icon">
              <i class="fas fa-frown"></i>
            </div>
          </div>
        </div>
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
      function dismissWelcomeAlert() {
          fetch('{{ route("dismiss-welcome-alert") }}', {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json'
              }
          }).then(() => {
              $('.alert').alert('close');
          });
      }

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