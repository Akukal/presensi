<!-- filepath: c:\xampp\htdocs\presensi\resources\views\website\setting\index.blade.php -->
@extends('website.layouts.app', ['title' => 'Setelan'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Setelan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Setelan</li>
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
            <form class="form-horizontal" method="POST" action="{{ $setting ? route('settings.update', $setting->id) : route('settings.store') }}">
              @csrf
              @if($setting)
                @method('PUT')
              @endif
              <div class="card-body">
                <div class="form-group">
                  <label for="mulai_masuk_siswa">Mulai Masuk Siswa</label>
                  <input type="time" name="mulai_masuk_siswa" class="form-control"
                    value="{{ old('mulai_masuk_siswa', $setting->mulai_masuk_siswa ?? '') }}"
                    {{ $setting ? '' : 'readonly' }} placeholder="--:--">
                </div>
                <div class="form-group">
                  <label for="jam_masuk_siswa">Jam Masuk Siswa</label>
                  <input type="time" name="jam_masuk_siswa" class="form-control"
                    value="{{ old('jam_masuk_siswa', $setting->jam_masuk_siswa ?? '') }}"
                    {{ $setting ? '' : 'readonly' }} placeholder="--:--">
                </div>
                <div class="form-group">
                  <label for="jam_pulang_siswa">Jam Pulang Siswa</label>
                  <input type="time" name="jam_pulang_siswa" class="form-control"
                    value="{{ old('jam_pulang_siswa', $setting->jam_pulang_siswa ?? '') }}"
                    {{ $setting ? '' : 'readonly' }} placeholder="--:--">
                </div>
                <div class="form-group">
                  <label for="batas_pulang_siswa">Batas Pulang Siswa</label>
                  <input type="time" name="batas_pulang_siswa" class="form-control"
                    value="{{ old('batas_pulang_siswa', $setting->batas_pulang_siswa ?? '') }}"
                    {{ $setting ? '' : 'readonly' }} placeholder="--:--">
                </div>
                @if(!$setting)
                  <div class="alert alert-info">Belum ada data setting, silakan klik tombol <b>Save</b> untuk membuat data baru.</div>
                @endif
              </div>
              <!-- /.card-body -->
              @can('edit setting')
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Atur Jadwal</button>
                </div>
              @endcan
              <!-- /.card-footer -->
            </form>
          </div>

          <!-- ...card API info tetap... -->

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection