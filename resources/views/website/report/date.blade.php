@extends('website.layouts.app', ['title' => 'Presence By Date'])

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
          <h1>Presence By Date</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Presence By Date</li>
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

          @canany(['export excel presence by date', 'export pdf presence by date'])
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Filter</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form action="{{ route('reports.date.export') }}" method="GET" target="_blank">
                  <div class="row">
                    <div class="col-4">
                      <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                      <div class="col-2">
                        @can('export excel presence by date')
                          <button class="btn btn-success" type="submit" value="excel" name="submit"><i class="fa fa-file-excel"></i></button> 
                        @endcan

                        @can('export pdf presence by date')
                          <button class="btn btn-danger" type="submit" value="pdf" name="submit"><i class="fa fa-file-pdf"></i></button> 
                        @endcan
                      </div>
                  </div>
                </form>
              </div>
              
            </div>
          @endcanany
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Position</th>
                  <th>Date</th>
                  <th>Clock In</th>
                  <th>Clock Out</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
              
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
    datatable();

    $('#date').on('change', function() {
      datatable();
    });
  });

  function datatable()
  {
    $('#datatable').DataTable().destroy();
    $('#datatable').DataTable({
      responsive    : true,
      processing    : true,
      serverSide    : true,
      ajax          : {
        url     : '{!! route('reports.date.ajax.datatable') !!}',
        data: {
          'date': $('#date').val()
        }
      },
      columns       : [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'staff.name', name: 'staff.name', orderable: true, searchable: true},                    
        {data: 'staff.department.name', name: 'staff.department.name', orderable: true, searchable: true},                    
        {data: 'staff.position.name', name: 'staff.position.name', orderable: true, searchable: true},                    
        {data: 'date', name: 'date', orderable: false, searchable: false},                    
        {data: 'clock_in', name: 'clock_in', orderable: false, searchable: false},                    
        {data: 'clock_out', name: 'clock_out', orderable: false, searchable: false},                    
        {data: 'status', name: 'status', orderable: false, searchable: false},                    
      ]
    });
  }
</script>
@endpush