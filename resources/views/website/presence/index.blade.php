@extends('website.layouts.app', ['title' => 'Presences'])

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Presences</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Presences</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0">Presence Today {{ \Carbon\Carbon::now()->format('d F Y') }}</h3>
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAbsenManual">
                <i class="fas fa-plus"></i> Absen Manual
              </button>
            </div>
            <div class="card-body" style="overflow-x:auto;">
              <table id="datatable" class="table table-striped table-bordered table-hover w-100">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Keluar</th>
                  <th>Status Masuk</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal Absen Manual -->
<div class="modal fade" id="modalAbsenManual" tabindex="-1" role="dialog" aria-labelledby="modalAbsenManualLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('presences.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAbsenManualLabel">Absen Manual</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="siswa_id">Nama Siswa</label>
            <select name="siswa_id" id="siswa_id" class="form-control" required>
              <option value="">-- Pilih Siswa --</option>
              @foreach(\App\Models\Siswa::all() as $siswa)
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').DataTable({
      responsive    : true,
      processing    : true,
      serverSide    : true,
      ajax          : {
        url     : '{!! route('presences.ajax.datatable') !!}',
      },
      columns       : [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'siswa.nama', name: 'siswa.nama', orderable: true, searchable: true},                    
        {data: 'siswa.kelas.kelas', name: 'siswa.kelas.kelas', orderable: true, searchable: true},
        {data: 'status', name: 'status', orderable: false, searchable: false},                    
        {data: 'tanggal', name: 'tanggal', orderable: false, searchable: false},                    
        {data: 'jam_masuk', name: 'jam_masuk', orderable: false, searchable: false},                    
        {data: 'jam_pulang', name: 'jam_pulang', orderable: false, searchable: false},                    
        {data: 'status_masuk', name: 'status_masuk', orderable: false, searchable: false},                    
      ]
    });
  });
</script>
@endpush
@endsection