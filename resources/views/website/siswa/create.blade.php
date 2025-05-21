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
                  <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Tempat Lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Tanggal Lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kelas</label>
                  <div class="col-sm-10">
                    <select name="code" class="form-control @error('code') is-invalid @enderror">
                      <option value="">[ Pilih Kelas ]</option>
                      @foreach($rfids as $rfid)
                          <option value="{{ $rfid->code }}" @selected(old('code') == $rfid->code)>{{ $rfid->code }}</option>
                      @endforeach
                    </select>
                    @error('code')
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
                        <option value="{{ $k->id }}" @selected(old('kelas_id') == $k->id)>{{ $k->name }}</option>
                      @endforeach
                    </select>
                    @error('kelas_id')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                    <textarea name="address" rows="5" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                    @error('address')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone Number" name="phone_number" value="{{ old('phone_number') }}">
                    @error('phone_number')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Start Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" placeholder="Start Date" name="start_date" value="{{ old('start_date') }}">
                    @error('start_date')
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