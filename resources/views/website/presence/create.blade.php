@extends('website.layouts.app', ['title' => 'Add Presensi Siswa'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Presensi Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Add Presensi</li>
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
            <div class="card-header">
              <a href="{{ route('presences.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('presences.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="siswa_id">Nama Siswa</label>
                  <select name="siswa_id" id="siswa_id" class="form-control" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach(\App\Models\Siswa::with('kelas')->get() as $siswa)
                    <option value="{{ $siswa->id }}">
                      {{ $siswa->nama }} ({{ $siswa->kelas->nama ?? '-' }})
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                  <label for="jam_masuk">Jam Masuk</label>
                  <input type="time" name="jam_masuk" id="jam_masuk" class="form-control">
                </div>
                <div class="form-group">
                  <label for="jam_pulang">Jam Pulang</label>
                  <input type="time" name="jam_pulang" id="jam_pulang" class="form-control">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control" required>
                    <option value="absen_masuk">Absen Masuk</option>
                    <option value="absen_pulang">Absen Pulang</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="alfa">Alfa</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="status_masuk">Status Masuk</label>
                  <select name="status_masuk" id="status_masuk" class="form-control">
                    <option value="">-</option>
                    <option value="tepat_waktu">Tepat Waktu</option>
                    <option value="telat">Telat</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- /.card-footer -->
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