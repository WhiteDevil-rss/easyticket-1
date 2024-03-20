@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add New Screen</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add New Screen</li>
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
              <h3 class="card-title">Add New Screen</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{route('admin.screen.add')}}">
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
                        <label for="select_theatre">Theatre:</label>
                        <select class="form-control form-select" name="select_theatre" id="select_theatre">
                            <option value="">Select Theatre</option>
                        </select>
                        @error('select_theatre')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        <br>

                        <label for="screen_name">Screen Name</label>
                        <input type="text" class="form-control" name="screen_name" id="screen_name" placeholder="Enter Screen Name">
                        @error('screen_name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror


                        @error('row')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        @error('startseatno')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        @error('endseatno')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        @error('position')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        @error('type')
                              <div class="alert alert-danger mt-2">{{ $message }}</div> 
                        @enderror

                        @error('price')
                              <div class="alert alert-danger mt-2">{{ $message }}</div> 
                        @enderror

                        <h3 class="mt-2 mb-2">Enter Seats row wise.</h3>
                        {{-- Dynamic row with input value from seatno to seat no, row, position, type and price with plus button next to add new row --}}
                        <div class="row mt-2 mb-2">
                          <div class="col-md-2">
                              <label for="startseatno">Starting Seat No</label>
                          </div>
                          <div class="col-md-2">
                              <label for="endseatno">Ending Seat No</label>
                          </div>
                          <div class="col-md-1">
                              <label for="row">Row</label>
                          </div>
                          <div class="col-md-2">
                              <label for="position">Position</label>
                          </div>
                          <div class="col-md-2">
                              <label for="type">Type</label>
                          </div>
                          <div class="col-md-1">
                              <label for="price">Price</label>
                          </div>
                        </div>
                        
                        <div class="row mt-2 mb-2">
                          <div class="col-md-2">
                              {{-- input error message --}}
                              @error('startseatno')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                              <input type="number" class="form-control" name="startseatno[]" id="startseatno" placeholder="Enter Seat No">
                          </div>
                          <div class="col-md-2">
                              <input type="number" class="form-control" name="endseatno[]" id="endseatno" placeholder="Enter Seat No">
                          </div>
                          <div class="col-md-1">
                              <input type="text" class="form-control" name="row[]" id="row" placeholder="Enter Row">
                          </div>
                          <div class="col-md-2">
                            <select class="form-select form-control" name="position[]" id="position[]">
                              <option value="Left" selected>Left</option>
                              <option value="Right">Right</option>
                              <option value="Middle">Middle</option>
                          </select>                          </div>
                          <div class="col-md-2">
                              <input type="text" class="form-control" name="type[]" id="type" placeholder="Enter Type">
                          </div>
                          <div class="col-md-1">
                              <input type="number" class="form-control" name="price[]" id="price" placeholder="Enter Price">
                          </div>
                          <div class="col-md-1 add_div">
                              <button type="button" class="btn btn-primary add">+</button>
                          </div>
                        </div>

                    <button type="submit" class="btn btn-primary">Add Screen</button>
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
    $(function () {
        //on click $document add create new row with new input and identifier of row id
        $(document).on('click', '.add', function () {
            var row = $(this).closest('.row');
            var clone = row.clone();
            var html = '<button type="button" class="btn btn-primary remove">-</button>';
            clone.find('.remove').remove();
            clone.find('.add_div').append(html);
            clone.find('input').val('');
            row.after(clone);
        });

        //on click $document remove row with identifier of row id
        $(document).on('click', '.remove', function () {
            $(this).closest('.row').remove();
        });

        //on change of city select option get theatre list
        var baseurl = '{{ url('') }}';
        $('#city').on('change', function() {
            var cityId = $(this).val();
            if(cityId) {
                $.ajax({
                    url: baseurl+"/admin/theatre/"+cityId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#select_theatre').empty();
                        $('#select_theatre').append('<option value="">Select a theater</option>');
                        $.each(data, function(key, value) {
                            $('#select_theatre').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#select_theatre').empty();
                $('#screen').empty();
            }
        });
  });
</script>
@endsection
