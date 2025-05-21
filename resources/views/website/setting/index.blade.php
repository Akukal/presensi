@extends('website.layouts.app', ['title' => 'Setting'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Setting</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Setting</li>
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
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('settings.store') }}">
              @csrf
              <div class="card-body">
              @if($setting)
                <div class="form-group row">
                  <input type="hidden" value="{{ $setting->id }}" name="id">
                  <label class="col-sm-2 col-form-label">Secret Key</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('secret_key') is-invalid @enderror" placeholder="Secret Key" name="secret_key" value="{{ old('secret_key', $setting->secret_key) }}" readonly>
                    @error('secret_key')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Mode</label>
                  <div class="col-sm-10">
                    <select name="mode" class="form-control @error('mode') is-invalid @enderror">
                      <option value="clock_in" @selected($errors->any() ? (old('mode') == "clock_in") : $setting->mode == "clock_in")>Clock In</option>
                      <option value="clock_out" @selected($errors->any() ? (old('mode') == "clock_out") : $setting->mode == "clock_out")>Clock Out</option>
                    </select>
                    @error('mode')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              @else
                <h3 class="card-title">Data setting tidak silakan lakukan generate data</h3>
              @endif
              </div>
              <!-- /.card-body -->
              @can('edit setting')
                <div class="card-footer">
                  @if($setting)
                    <button type="submit" class="btn btn-primary">Save</button>
                  @endif
                  <button type="submit" class="btn btn-danger" name="new_secret_key" value="new_secret_key">Generate New Secret Key</button>
                </div>
              @endcan
              <!-- /.card-footer -->
            </form>
          </div>

          <div class="card">
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('settings.store') }}">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Mode Device (Reader / Add Card)</label>
                  <label class="col-sm-9 col-form-label"><code>{{ env('APP_URL') }}/api/v1/devices/mode?secret_key={secret_key}&device_id={xxx}</code></label>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Save Presence</label>
                  <label class="col-sm-9 col-form-label"><code>{{ env('APP_URL') }}/api/v1/presences/store?secret_key={secret_key}&device_id={xxx}&rfid={xxx}</code></label>
                </div>

              </div>
              <!-- /.card-body -->
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