@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit Theatre</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Theatre</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edit Theatre</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('admin.theatres.update', $theatre->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Theatre Name:</label>
                        <input id="name" type="text" name="name" class="form-control" value="{{$theatre->name}}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="phone_no">Phone Number:</label>
                        <input id="phone_no" type="text" name="phone_no" class="form-control" value="{{$theatre->phone_no}}" required>
                        @error('phone_no')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="city_id">City:</label>
                        <select id="city_id" name="city_id" class="form-control" required>
                            <option value="">-- Select a city --</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $theatre->city_id == $city->id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="address">Theatre Address:</label>
                        <textarea id="address" name="address" class="form-control" required>{{$theatre->address}}</textarea>
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="is_active">Is Active:</label>
                        <select id="is_active" name="is_active" class="form-control" required>
                            <option value="1" {{ $theatre->is_active == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $theatre->is_active == 0 ? 'selected' : '' }}>No</option>
                        </select>
                        @error('is_active')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <button type="submit" class="btn btn-primary">Update Theatre</button>
                </form>
            </div>
            <!-- /.card-body -->
          </div>
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
@endsection
@section('adminscript')
<script>
    
</script>
@endsection
                
