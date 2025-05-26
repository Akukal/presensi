@extends('website.layouts.app', ['title' => 'Detail Absensi Siswa'])

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <style>
    .badge { font-size: 12px; }
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
        <div class="col-sm-6"><h1>Detail Absensi Siswa</h1></div>
        <div class="col-sm-6"> 
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Detail Absensi Siswa</li>
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
              <label>Bulan</label>
              <input type="month" class="form-control" id="bulan" name="bulan" value="{{ date('Y-m') }}">
            </div>
            <div class="col-md-3 mb-2">
              <label>Kelas</label>
              <select class="form-control" id="kelas_id" name="kelas_id">
                <option value="">- Semua Kelas -</option>
                @foreach($kelasList as $kelas)
                  <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 mb-2 d-flex align-items-end">
              {{-- <button type="button" class="btn btn-primary mr-2" id="btn-search"><i class="fa fa-search"></i></button> --}}
              <button type="button" class="btn btn-success mr-2" id="btn-excel"><i class="fa fa-file-excel"></i></button>
              <button type="button" class="btn btn-danger mr-2" id="btn-pdf"><i class="fa fa-file-pdf"></i></button>
            </div>
          </form>
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover w-100"></table>
          </div>
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
function getDatesInMonth(year, month) {
  let date = new Date(year, month - 1, 1);
  let result = [];
  while (date.getMonth() + 1 === month) {
    result.push(date.toISOString().slice(0, 10));
    date.setDate(date.getDate() + 1);
  }
  return result;
}

function loadTable() {
  let bulan = $('#bulan').val();
  let year = parseInt(bulan.split('-')[0]);
  let month = parseInt(bulan.split('-')[1]);
  let dates = getDatesInMonth(year, month);

  let columns = [
    {data: 'nis', title: 'NIS', name: 'nis'},
    {data: 'nama', title: 'Nama', name: 'nama'},
    {data: 'kelas', title: 'Kelas', name: 'kelas'}
  ];
  dates.forEach(function(tgl) {
    let tglObj = new Date(tgl);
    let title = tglObj.getDate() + '/' + (tglObj.getMonth() + 1);
    columns.push({
      data: tgl,
      title: title,
      name: tgl,
      orderable: false,
      searchable: false,
      defaultContent: '-'
    });
  });

  if ($.fn.DataTable.isDataTable('#datatable')) {
    $('#datatable').DataTable().clear().destroy();
    $('#datatable').empty();
  }

  $('#datatable').DataTable({
  responsive: true,
  processing: true,
  serverSide: true,
  scrollX: true,
  searching: false,
  ajax: {
    url: '{{ route("laporan.siswa.detail.ajax.datatable") }}',
    data: {
      bulan: $('#bulan').val(),
      kelas_id: $('#kelas_id').val(),
    }
  },
  columns: columns,
  dom: 'Bfrtip',
  paging: true,
  searching: false,
  info: true,
  ordering: false,
  scrollX: true,
  lengthChange: true, // Pastikan ini diaktifkan
  lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]], // Konfigurasi menu panjang
  pageLength: 25,
});
}
$(document).ready(function() {
  loadTable();
  $('#btn-search, #kelas_id, #bulan').on('click change', function() {
    loadTable();
  });
  $('#btn-excel').on('click', function() {
    window.open("{{ route('laporan.siswa.detail.export') }}?" + $('#filter-form').serialize() + "&submit=excel", "_blank");
  });
  $('#btn-pdf').on('click', function() {
    window.open("{{ route('laporan.siswa.detail.export') }}?" + $('#filter-form').serialize() + "&submit=pdf", "_blank");
  });
});
</script>
@endpush