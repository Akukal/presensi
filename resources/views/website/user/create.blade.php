@extends('website.layouts.app', ['title' => 'Add User'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Add User</li>
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
              <a href="{{ route('users.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('users.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}">
                    @error('name')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
                    @error('email')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Role</label>
                  <div class="col-sm-10">
                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                      <option value="">[ Select Role ]</option>
                      @foreach($roles as $role)
                        <option value="{{ $role }}" @selected(old('role') == $role)>{{ $role }}</option>
                      @endforeach
                    </select>
                    @error('role')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" value="{{ old('password') }}">
                    @error('password')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Password Confirmation</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password Confirmation" name="password_confirmation">
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