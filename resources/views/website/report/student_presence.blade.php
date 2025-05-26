@extends('website.layouts.app', ['title' => 'Presensi By Siswa'])

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Laporan per Siswa</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('laporan.siswa') }}">Laporan By Siswa</a></li>
            <li class="breadcrumb-item active">Laporan per Siswa</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row"><div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('laporan.siswa') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
            <div class="card-title float-right">Detail Siswa</div>
          </div>
          <div class="card-body">
            <table class="table table-striped table-bordered table-hover mb-0">
              <thead>
                <tr>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Kelas</th>
                  <th>Nomor Orang Tua</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $siswa->nis }}</td>
                  <td>{{ $siswa->nama }}</td>
                  <td>
                    @if ($siswa->jenis_kelamin == 'L') <span class='badge badge-success'>Pria</span>
                    @else <span class='badge badge-danger'>Wanita</span>
                    @endif
                  </td>
                  <td>{{ $siswa->kelas->nama ?? '-' }}</td>
                  <td>{{ $siswa->nomor_orang_tua }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        @canany(['export excel presence by student', 'export pdf presence by student'])
        <div class="card">
          <div class="card-header"><h3 class="card-title">Filter</h3></div>
          <div class="card-body">
            <form action="{{ route('laporan.siswa.export', $siswa->id) }}" method="GET" target="_blank" class="form-inline mb-3">
              <label class="mr-2">Tanggal Mulai</label>
              <input type="date" class="form-control mr-2" name="start_date" id="start_date" onChange="datatable()" required>
              <label class="mr-2">Tanggal Selesai</label>
              <input type="date" class="form-control mr-2" name="end_date" id="end_date" onChange="datatable()" required>
              @can('export excel presence by student')
                <button class="btn btn-success mr-2" type="submit" value="excel" name="submit" title="Export Excel"><i class="fa fa-file-excel"></i></button>
              @endcan
              @can('export pdf presence by student')
                <button class="btn btn-danger" type="submit" value="pdf" name="submit" title="Export PDF"><i class="fa fa-file-pdf"></i></button>
              @endcan
            </form>
          </div>
        </div>
        @endcanany

        <div class="card">
          <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered table-hover w-100">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Absen Masuk</th>
                  <th>Absen Pulang</th>
                  <th>Status</th>
                  <th>Status Masuk</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
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
function datatable()
{
  var siswaId = "{{ $siswa->id }}";
  var route = '{!! route('laporan.siswa.presensi.ajax.datatable', ':id') !!}';
  var link = route.replace(':id', siswaId);

  $('#datatable').DataTable().destroy();
  $('#datatable').DataTable({
    responsive : true,
    processing : true,
    serverSide : true,
    ajax : {
      url     : link,
      data: {
        'start_date': $('#start_date').val(),
        'end_date': $('#end_date').val(),
      }
    },
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'tanggal', name: 'tanggal'},
      {data: 'jam_masuk', name: 'jam_masuk'},
      {data: 'jam_pulang', name: 'jam_pulang'},
      {data: 'status', name: 'status'},
      {data: 'status_masuk', name: 'status_masuk'},
      {data: 'keterangan', name: 'keterangan'},
    ]
  });
}
$(document).ready(function() {
  datatable();
  $('#start_date, #end_date').on('change', function() {
    datatable();
  });
});
</script>
@endpush