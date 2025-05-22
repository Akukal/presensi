@extends('website.layouts.app', ['title' => 'Rekap Absensi Siswa'])

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Rekap Absensi Siswa</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active">Rekap Absensi Siswa</li>
        </ol>
      </div>
      </div>
    </div>
    </section>
    <section class="content">
    <div class="container-fluid">
      <div class="card">
      <div class="card-body pb-0">
        <form id="filter-form" class="form-row align-items-end mb-3">
        <div class="col-md-3 mb-2">
          <label>Tanggal Awal</label>
          <input type="date" class="form-control" id="start_date" name="start_date">
        </div>
        <div class="col-md-3 mb-2">
          <label>Tanggal Akhir</label>
          <input type="date" class="form-control" id="end_date" name="end_date">
        </div>
        <div class="col-md-3 mb-2">
          <label>Kelas</label>
          <select class="form-control" id="kelas_id" name="kelas_id">
          <option value="">[Semua Kelas]</option>
          @foreach($kelasList as $kelas)
        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
      @endforeach
          </select>
        </div>
        <div class="col-md-3 mb-2 d-flex align-items-end" style="gap: 10px;">
          <button type="button" class="btn btn-primary w-100" id="btn-search"><i class="fa fa-search"></i></button>
          <button type="button" class="btn btn-success w-100" id="btn-excel"><i
            class="fa fa-file-excel"></i></button>
          <button type="button" class="btn btn-danger w-100" id="btn-pdf"><i class="fa fa-file-pdf"></i></button>
        </div>
        </form>
      </div>
      <div class="card-body pt-0">
        <table id="datatable" class="table table-bordered table-hover w-100">
        <thead>
          <tr>
          <th>No</th>
          <th>NIS</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Masuk</th>
          <th>Telat</th>
          <th>Sakit</th>
          <th>Ijin</th>
          <th>Alfa</th>
          </tr>
        </thead>
        <tbody></tbody>
        </table>
      </div>
      </div>
    </div>
    </section>
  </div>
@endsection

@push('scripts')
  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script>
    function loadTable() {
    $('#datatable').DataTable().destroy();
    $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
      url: '{{ route("laporan.siswa.rekap.ajax.datatable") }}',
      data: {
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val(),
        kelas_id: $('#kelas_id').val(),
      }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
      { data: 'nis', name: 'nis' },
      { data: 'nama', name: 'nama' },
      { data: 'kelas', name: 'kelas' },
      { data: 'masuk', name: 'masuk' },
      { data: 'telat', name: 'telat' },
      { data: 'sakit', name: 'sakit' },
      { data: 'ijin', name: 'ijin' },
      { data: 'alfa', name: 'alfa' },
      ]
    });
    }
    $(document).ready(function () {
    loadTable();
    $('#btn-search, #kelas_id, #start_date, #end_date').on('click change', function () {
      loadTable();
    });
    $('#btn-excel').on('click', function () {
      window.open("{{ route('laporan.siswa.rekap.export') }}?" + $('#filter-form').serialize() + "&submit=excel", "_blank");
    });
    $('#btn-pdf').on('click', function () {
      window.open("{{ route('laporan.siswa.rekap.export') }}?" + $('#filter-form').serialize() + "&submit=pdf", "_blank");
    });
    });
  </script>
@endpush