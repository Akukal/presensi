@extends('website.layouts.app', ['title' => 'Add Siswa'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Add Siswa</li>
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
              <a href="{{ route('siswa.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('siswa.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">NIS</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('nis') is-invalid @enderror" placeholder="NIS" name="nis" value="{{ old('nis') }}">
                    @error('nis')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                      <option value="">[ Pilih Jenis Kelamin ]</option>
                      <option value="1" @selected(old('gender') == "1")>Pria</option>
                      <option value="2" @selected(old('gender') == "2")>Wanita</option>
                    </select>
                    @error('gender')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kelas</label>
                  <div class="col-sm-10">
                    <select name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
                      <option value="">[ Select Kelas ]</option>
                      @foreach($kelas as $k)
                        <option value="{{ $k->id }}" @selected(old('kelas_id') == $k->id)>{{ $k->nama }}</option>
                      @endforeach
                    </select>
                    @error('kelas_id')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No. Telepon Wali Murid</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('telepon_wali') is-invalid @enderror" placeholder="No. Telepon Wali Murid" name="telepon_wali" value="{{ old('telepon_wali') }}">
                    @error('telepon_wali')
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