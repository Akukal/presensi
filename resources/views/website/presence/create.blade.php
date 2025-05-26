@extends('website.layouts.app', ['title' => 'Tambah Absensi'])

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Absensi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('presences.index') }}">Absensi</a></li>
            <li class="breadcrumb-item active">Tambah Absensi</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('presences.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('presences.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="siswa_id">Nama Siswa</label>
                  <select name="siswa_id" id="siswa_id" class="form-select" required>
                    <option value="" selected disabled>[ Pilih Siswa ]</option>
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
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-select" required>
                    <option value="absen_masuk">Absen Masuk</option>
                    <option value="absen_pulang">Absen Pulang</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="alfa">Alfa</option>
                  </select>
                </div>
                <div id="jam-status-group">
                  <div class="form-group">
                    <label for="jam_masuk">Jam Masuk</label>
                    <input type="time" name="jam_masuk" id="jam_masuk" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="jam_pulang">Jam Pulang</label>
                    <input type="time" name="jam_pulang" id="jam_pulang" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Status Masuk</label><br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status_masuk" id="tepat_waktu" value="tepat_waktu">
                      <label class="form-check-label" for="tepat_waktu">Tepat Waktu</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status_masuk" id="telat" value="telat">
                      <label class="form-check-label" for="telat">Terlambat</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea name="keterangan" id="keterangan" class="form-control text-keterangan"></textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<style>
  .text-keterangan {
    height: 100%;
    min-height: 20px;
    max-height: 400px;
  }
</style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
  function toggleJamStatus() {
    let val = $('#status').val();
    // Sembunyikan jam dan status_masuk jika izin/sakit/alfa
    if (val == 'izin' || val == 'sakit' || val == 'alfa') {
      $('#jam-status-group').hide();
      $('#jam_masuk').val('');
      $('#jam_pulang').val('');
      $('input[name="status_masuk"]').prop('checked', false);
    } else {
      $('#jam-status-group').show();
    }
  }
  $('#status').on('change', toggleJamStatus);
  toggleJamStatus();
});
</script>
@endpush