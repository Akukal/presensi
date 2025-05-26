@extends('website.layouts.app', ['title' => 'Laporan per Kelas'])

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laporan per Kelas</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active">Laporan per Kelas</li>
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
            <label for="filter-kelas" class="mr-2 py-2">Filter</label>
            <select name="kelas" id="filter-kelas" class="form-control" style="min-width:180px;">
              <option value="">[ Pilih Kelas ]</option>
              @foreach($kelasList as $kelas)
              <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="card-body" style="overflow-x:auto;">
          <table id="datatable" class="table table-bordered table-hover w-100">
          <thead>
            <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Kelas</th>
            <th>Nomor Orang Tua</th>
            <th>Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
          </table>
        </div>
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
    $(document).ready(function () {
    loadTable();
    $('#filter-kelas').on('change', function () {
      loadTable();
    });
    });
    function loadTable() {
    $('#datatable').DataTable().destroy();
    $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      scrollX: true,
      ajax: {
      url: '{!! route('laporan.siswa.ajax.datatable') !!}',
      data: { kelas_id: $('#filter-kelas').val() }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
      { data: 'nis', name: 'nis' },
      { data: 'nama', name: 'nama' },
      { data: 'gender', name: 'gender' },
      { data: 'kelas', name: 'kelas' },
      { data: 'nomor_orang_tua', name: 'nomor_orang_tua' },
      { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
      ]
    });
    }
  </script>
@endpush