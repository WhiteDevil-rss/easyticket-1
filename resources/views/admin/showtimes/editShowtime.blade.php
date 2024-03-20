@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Modify Showtime</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Modify Showtime</li>
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
              <h3 class="card-title">Add showtime</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{route('admin.showtimes.update')}}">
                    @csrf
                    <div class="form-group">
                        <label for="city">City:</label>
                        <select name="city" id="city" class="form-control" disabled>
                            <option value="{{ $city->city_id }}" selected>{{ $city->city_name }}</option>
                        </select>
                        <input type="hidden" name="showtime_id" value="{{ $showtime->showtimes_id }}">
                    </div>
    
                    <div class="form-group">
                        <label for="theater">Theater:</label>
                        <select name="theater" id="theater" class="form-control" disabled>
                            <option value="">Select a theater</option>
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="screen">Screen:</label>
                        <select name="screen" id="screen" class="form-control">
                            <option value="">Select a screen</option>
                            @foreach ($screens as $sdata)
                                <option value="{{ $sdata->id }}" @if($sdata->id == $showtime->screen_id) selected @endif>{{ $sdata->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="movie">Movie:</label>
                        <select name="movie" id="movie" class="form-control">
                            <option value="">Select a movie</option>
                            @foreach ($movies as $movie)
                                <option value="{{ $movie->id }}" selected>{{ $movie->title }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="start_time">Start Time:</label>
                        <input type="datetime-local" name="start_time" id="start_time" value="{{$showtime->start_time}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="end_time">End Time:</label>
                        <input type="datetime-local" name="end_time" id="end_time" value="{{$showtime->end_time}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="price_factor">Price Factor:</label>
                        <input type="number" name="price_factor" id="price" value="{{$showtime->price_factor}}" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" @if($showtime->showtime_is_active == '1' ) selected @endif>Active</option>
                            <option value="0"  @if($showtime->showtime_is_active == '0') selected @endif>Inactive</option>
                        </select>
                    </div>
    
                    <button type="submit" class="btn btn-primary">Update Showtime</button>
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
    $(document).ready(function() {
        var baseurl = '{{ url('') }}';
        var cityId = $('#city').val();
        if(cityId) {
            $.ajax({
                url: baseurl+"/admin/theatre/"+cityId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#theater').empty();
                    $.each(data, function(key, value) {
                        $('#theater').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                }
            });
        } else {
            $('#theater').empty();
            $('#screen').empty();
        }
});
</script>
@endsection
                
