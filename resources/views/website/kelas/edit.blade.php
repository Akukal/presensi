@extends('website.layouts.app', ['title' => 'Edit Kelas'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Kelas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Edit Kelas</li>
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
          <div class="card">
            <div class="card-header">
              <a href="{{ route('kelas.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
            </div>

            <form class="form-horizontal" method="POST" action="{{ route('kelas.update', $kelas->id) }}">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Kelas</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Kelas" name="name" value="{{ old('name', $kelas->kelas) }}">
                    @error('kelas')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>
@endsection
