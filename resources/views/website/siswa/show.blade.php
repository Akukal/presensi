@extends('website.layouts.app', ['title' => 'Detail Siswa'])

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
          <h1>Detail Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Detail Siswa</li>
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
            <div class="card-header">
              <a href="{{ route('siswa.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th>RFID</th>
                        <td>:</td>
                        <td>{{ $siswa->code }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>:</td>
                        <td>{{ $siswa->name }}</td>
                    </tr>
                    <tr>
                        <th>Departement</th>
                        <td>:</td>
                        <td>{{ $siswa->department->name }}</td>
                    </tr>
                    <tr>
                        <th>Position</th>
                        <td>:</td>
                        <td>{{ $siswa->position->name }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>:</td>
                        <td>{{ $siswa->gender == 1 ? "Male" : "Female" }}</td>
                    </tr>
                    <tr>
                        <th>Birth Of Date</th>
                        <td>:</td>
                        <td>{{ $siswa->birth_of_date }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>:</td>
                        <td>{{ $siswa->address }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>:</td>
                        <td>{{ $siswa->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>:</td>
                        <td>{{ $siswa->start_date }}</td>
                    </tr>
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
