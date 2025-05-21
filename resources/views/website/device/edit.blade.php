@extends('website.layouts.app', ['title' => 'Edit Device'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Device</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Edit Device</li>
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
              <a href="{{ route('devices.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('devices.update', $device->id) }}">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name', $device->name) }}">
                    @error('name')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Mode</label>
                  <div class="col-sm-10">
                    <select name="mode" class="form-control @error('mode') is-invalid @enderror">
                      <option value="">[ Select Mode ]</option>
                      <option value="reader" @selected($errors->any() ? (old('mode') == "reader") : ($device->mode == "reader"))>Reader</option>
                      <option value="add_card" @selected($errors->any() ? (old('mode') == "add_card") : ($device->mode == "add_card"))>Add Card</option>
                    </select>
                    @error('mode')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                    <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
                      <option value="">[ Select Status ]</option>
                      <option value="1" @selected($errors->any() ? (old('is_active') == "1") : ($device->is_active == "1"))>Aktif</option>
                      <option value="0" @selected($errors->any() ? (old('is_active') == "0") : ($device->is_active == "0"))>Non-Aktif</option>
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