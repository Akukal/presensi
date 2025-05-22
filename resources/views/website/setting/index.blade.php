@extends('website.layouts.app', ['title' => 'Setting'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Setting</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Setting</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- /.card -->
          <!-- Horizontal Form -->
          <div class="card">
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('settings.store') }}">
              @csrf
              <div class="card-body">
              @if($setting)
                <div class="form-group">
                  <label for="mulai_masuk_siswa">Mulai Masuk Siswa</label>
                  <input type="time" name="mulai_masuk_siswa" class="form-control" value="{{ old('mulai_masuk_siswa', $setting->mulai_masuk_siswa ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="jam_masuk_siswa">Jam Masuk Siswa</label>
                    <input type="time" name="jam_masuk_siswa" class="form-control" value="{{ old('jam_masuk_siswa', $setting->jam_masuk_siswa ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="jam_pulang_siswa">Jam Pulang Siswa</label>
                    <input type="time" name="jam_pulang_siswa" class="form-control" value="{{ old('jam_pulang_siswa', $setting->jam_pulang_siswa ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="batas_pulang_siswa">Batas Pulang Siswa</label>
                    <input type="time" name="batas_pulang_siswa" class="form-control" value="{{ old('batas_pulang_siswa', $setting->batas_pulang_siswa ?? '') }}">
                </div>
              @else
                <h3 class="card-title">Data setting tidak silakan lakukan generate data</h3>
              @endif
              </div>
              <!-- /.card-body -->
              @can('edit setting')
                <div class="card-footer">
                  @if($setting)
                    <button type="submit" class="btn btn-primary">Save</button>
                  @endif
                </div>
              @endcan
              <!-- /.card-footer -->
            </form>
          </div>

          <div class="card">
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('settings.store') }}">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Mode Device (Reader / Add Card)</label>
                  <label class="col-sm-9 col-form-label"><code>{{ env('APP_URL') }}/api/v1/devices/mode?secret_key={secret_key}&device_id={xxx}</code></label>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Save Presence</label>
                  <label class="col-sm-9 col-form-label"><code>{{ env('APP_URL') }}/api/v1/presences/store?secret_key={secret_key}&device_id={xxx}&rfid={xxx}</code></label>
                </div>

              </div>
              <!-- /.card-body -->
            </form>
          </div>
          <!-- /.card -->

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection