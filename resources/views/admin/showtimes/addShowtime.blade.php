@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Add Showtime</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Showtime</li>
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
                <form method="POST" action="{{route('admin.showtimes.add')}}">
                    @csrf
                    <div class="form-group">
                        <label for="city">City:</label>
                        <select name="city" id="city" class="form-control">
                            <option value="">Select a city</option>
                            @foreach ($city as $citydata)
                            <option value="{{ $citydata->id }}">{{ $citydata->city_name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="theater">Theater:</label>
                        <select name="theater" id="theater" class="form-control">
                            <option value="">Select a theater</option>
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="screen">Screen:</label>
                        <select name="screen" id="screen" class="form-control">
                            <option value="">Select a screen</option>
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="movie">Movie:</label>
                        <select name="movie" id="movie" class="form-control">
                            <option value="">Select a movie</option>
                            @foreach ($movies as $movie)
                            <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="start_time">Start Time:</label>
                        <input type="datetime-local" name="start_time" id="start_time" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="end_time">End Time:</label>
                        <input type="datetime-local" name="end_time" id="end_time" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="price_factor">Price Factor:</label>
                        <input type="number" name="price_factor" id="price" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
    
                    <button type="submit" class="btn btn-primary">Add Showtime</button>
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
    $('#city').on('change', function() {
        var cityId = $(this).val();
        if(cityId) {
            $.ajax({
                url: baseurl+"/admin/theatre/"+cityId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#theater').empty();
                    $('#theater').append('<option value="">Select a theater</option>');
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

    $('#theater').on('change', function() {
        var theaterId = $(this).val();
        if(theaterId) {
            $.ajax({
                url: baseurl+'/admin/screens/' + theaterId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#screen').empty();
                    $('#screen').append('<option value="">Select a screen</option>');
                    $.each(data, function(key, value) {
                        $('#screen').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                }
            });
        } else {
            $('#screen').empty();
        }
    });
});
</script>
@endsection
                
