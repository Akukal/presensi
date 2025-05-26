@extends('website.layouts.app', ['title' => 'Laporan per Tanggal'])

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <style>
    .export-btn-group {
      display: flex;
      gap: 8px; 
      align-items: center;
      margin-left: 12px;
    }
  </style>
  <style>
    .dataTables_length select {
        padding-right: 18px;
        margin: 0;
        font-size: 12px;
    }
    </style>
@endpush

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan per Tanggal</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Laporan per Tanggal</li>
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
          <div class="card-header">
            <div class="form-inline">
              <label for="filter-kelas" class="mr-3 py-2">Filter</label>
              <form id="filter-form" class="form-inline">
                <input type="date" class="form-control mr-2" id="date" name="date" placeholder="Pilih tanggal">
                @canany(['export excel presence by date', 'export pdf presence by date'])
                  <input type="hidden" id="export-date" name="date" value="">
                  <span class="export-btn-group">
                    @can('export excel presence by date')
                      <button type="button" class="btn btn-success" id="btn-export-excel" title="Export Excel">
                        <i class="fa fa-file-excel"></i>
                      </button>
                    @endcan
                    @can('export pdf presence by date')
                      <button type="button" class="btn btn-danger" id="btn-export-pdf" title="Export PDF">
                        <i class="fa fa-file-pdf"></i>
                      </button>
                    @endcan
                  </span>
                @endcanany
              </form>
            </div>
          </div>
          <div class="card-body">
            
            <div style="overflow-x: auto;">
              <table id="datatable" class="table table-striped table-bordered table-hover w-100">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Absen Masuk</th>
                  <th>Absen Pulang</th>
                  <th>Kehadiran</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div></div>
    </div>
  </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
  $(document).ready(function() {
    loadTable();

    $('#date').on('change', function() {
      $('#export-date').val($(this).val());
      loadTable();
    });

    // Export Excel
    $('#btn-export-excel').on('click', function() {
      var tanggal = $('#date').val();
      if (!tanggal) {
        alert('Pilih tanggal terlebih dahulu!');
        return;
      }
      window.open("{{ route('reports.date.export') }}?date=" + tanggal + "&submit=excel", "_blank");
    });

    // Export PDF
    $('#btn-export-pdf').on('click', function() {
      var tanggal = $('#date').val();
      if (!tanggal) {
        alert('Pilih tanggal terlebih dahulu!');
        return;
      }
      window.open("{{ route('reports.date.export') }}?date=" + tanggal + "&submit=pdf", "_blank");
    });
  });

  function loadTable() {
    $('#datatable').DataTable().destroy();
    $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: {
        url: '{{ route('reports.date.ajax.datatable') }}',
        data: { 'date': $('#date').val() }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'siswa.nis', name: 'siswa.nis'},
        {data: 'siswa.nama', name: 'siswa.nama'},
        {data: 'kelas', name: 'kelas'},
        {data: 'status', name: 'status'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'jam_masuk', name: 'jam_masuk'},
        {data: 'jam_pulang', name: 'jam_pulang'},
        {data: 'status_masuk', name: 'status_masuk'},
        {data: 'keterangan', name: 'keterangan'},
      ]
    });
  }
</script>
@endpush