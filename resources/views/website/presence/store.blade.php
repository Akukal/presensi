@extends('website.layouts.app', ['title' => 'Tambah Presensi Manual'])

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Presensi Manual</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('presences.index') }}">Presences</a></li>
            <li class="breadcrumb-item active">Tambah Presensi</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Form Presensi Manual</h3>
            </div>
            <form action="{{ route('presences.store') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="siswa_id">Nama Siswa</label>
                  <select name="siswa_id" id="siswa_id" class="form-control" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach(\App\Models\Siswa::with('kelas')->get() as $siswa)
                      <option value="{{ $siswa->id }}">{{ $siswa->nama }} ({{ $siswa->kelas->kelas ?? '-' }})</option>
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
              <div class="card-footer">
                <a href="{{ route('presences.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection