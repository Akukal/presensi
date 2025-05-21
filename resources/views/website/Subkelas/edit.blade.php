@extends('website.layouts.app', ['title' => 'Edit Position'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Position</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Edit Position</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- /.card -->
          <!-- Horizontal Form -->
          <div class="card">
            <div class="card-header">
              <a href="{{ route('positions.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('positions.update', $position->id) }}">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name', $position->name) }}">
                    @error('name')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                    <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
                      <option value="">[ Pilih Status ]</option>
                      <option value="1" @selected($errors->any() ? (old('is_active') == "1") : ($position->is_active == "1"))>Aktif</option>
                      <option value="0" @selected($errors->any() ? (old('is_active') == "0") : ($position->is_active == "0"))>Non-Aktif</option>
                    </select>
                    @error('is_active')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.card -->

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection