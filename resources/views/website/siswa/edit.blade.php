@extends('website.layouts.app', ['title' => 'Edit Staff'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Staff</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Edit Staff</li>
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
              <a href="{{ route('staff.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('staff.update', $staff->id) }}">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">RFID</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control @error('code') is-invalid @enderror" placeholder="code" name="code" value="{{ old('code', $staff->code) }}" readonly>
                      @error('code')
                        <span class="error invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name', $staff->name) }}">
                    @error('name')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Gender</label>
                  <div class="col-sm-10">
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                      <option value="">[ Select Gender ]</option>
                      <option value="1" @selected($errors->any() ? (old('gender') == "1") : ($staff->gender == "1"))>Male</option>
                      <option value="2" @selected($errors->any() ? (old('gender') == "2") : ($staff->gender == "2"))>Female</option>
                    </select>
                    @error('gender')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Birth Of Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control @error('birth_of_date') is-invalid @enderror" placeholder="Birth Of Date" name="birth_of_date" value="{{ old('birth_of_date', $staff->birth_of_date) }}">
                    @error('birth_of_date')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Department</label>
                  <div class="col-sm-10">
                    <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                      <option value="">[ Select Department ]</option>
                      @foreach($departments as $department)
                        <option value="{{ $department->id }}" @selected($errors->any() ? (old('department_id') == $department->id) : ($staff->department_id == $department->id))>{{ $department->name }}</option>
                      @endforeach
                    </select>
                    @error('department_id')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Position</label>
                  <div class="col-sm-10">
                    <select name="position_id" class="form-control @error('position_id') is-invalid @enderror">
                      <option value="">[ Select Position ]</option>
                      @foreach($positions as $position)
                      <option value="{{ $position->id }}" @selected($errors->any() ? (old('position_id') == $position->id) : ($staff->position_id == $position->id))>{{ $position->name }}</option>
                      @endforeach
                    </select>
                    @error('position_id')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                    <textarea name="address" rows="5" class="form-control @error('address') is-invalid @enderror">{{ old('address', $staff->address) }}</textarea>
                    @error('address')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone Number" name="phone_number" value="{{ old('phone_number', $staff->phone_number) }}">
                    @error('phone_number')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Start Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" placeholder="Start Date" name="start_date" value="{{ old('start_date', $staff->start_date) }}">
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