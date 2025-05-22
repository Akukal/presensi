@extends('website.layouts.app', ['title' => 'Siswa'])

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Absen Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Absen Siswa</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            @can('create presence')
              <div class="card-header d-flex justify-content-end">
                <a href="{{ route('presences.create') }}" class="btn btn-primary">
                  <i class="fa fa-plus"></i> Tambah
                </a>
              </div>
            @endcan
            <!-- /.card-header -->
            <div class="card-body" style="overflow-x:auto;">
              <table id="datatable" class="table table-bordered table-hover w-100">
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
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').DataTable({
      responsive : true,
      processing : true,
      serverSide : true,
      scrollX : true,
      ajax : {
        url : '{!! route('presences.ajax.datatable') !!}',
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'nama', name: 'nama'},
        {data: 'kelas', name: 'kelas'},
        {data: 'status', name: 'status'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'jam_masuk', name: 'jam_masuk'},
        {data: 'jam_pulang', name: 'jam_pulang'},
        {data: 'status_masuk', name: 'status_masuk'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
    });
  });

  function deleteConfirm(id) {
    Swal.fire({
      text: "Are you sure you want to delete data ?",
      type: 'warning',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
      }).then((result) => {
      if (result.value) {
        $('#submit_'+id).submit();
        Swal.fire(
          'Deleted!',
          'Staff data deleted',
          'success'
        )   
      }
    })
  }
</script>
@endpush