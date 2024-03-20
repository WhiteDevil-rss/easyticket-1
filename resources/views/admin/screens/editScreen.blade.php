@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Modify {{$screen->screen_name}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Screen</li>
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
              <h3 class="card-title">Modify theatre screen: {{$screen->screen_name}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{route('admin.screen.update')}}">
                    @csrf
                    <div class="form-group">
                        <select class="form-control form-select" name="select_theatre" id="select_theatre">
                                <option value="{{$screen->theaters_id}}" selected>{{$screen->theatre_name}}</option>
                        </select>
                        <input type="hidden" name="screen_id" value="{{$screen->screen_id}}" id="screen_id">
                        @error('select_theatre')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        <br>

                        <label for="screen_name">Screen Name</label>
                        <input type="text" class="form-control" name="screen_name" id="screen_name" placeholder="Enter Screen Name" value="{{$screen->screen_name}}">
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
                        
                        @foreach($seat_row as $seatdata)
                          <div class="row mt-2 mb-2">
                            <div class="col-md-2">
                                <input type="number" class="form-control" name="startseatno[]" id="startseatno" placeholder="Enter Seat No" value="{{$seatdata->min_seat_no}}">
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control" name="endseatno[]" id="endseatno" placeholder="Enter Seat No" value="{{$seatdata->max_seat_no}}">
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" name="row[]" id="row" placeholder="Enter Row" value="{{$seatdata->row}}">
                            </div>
                            <div class="col-md-2">
                                <select class="form-select form-control" name="position[]" id="position[]">
                                    <option value="Left" @if($seatdata->position == "Left") selected @endif>Left</option>
                                    <option value="Right" @if($seatdata->position == "Right") selected @endif>Right</option>
                                    <option value="Center" @if($seatdata->position == "Center") selected @endif>Center</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="type[]" id="type" placeholder="Enter Type" value="{{$seatdata->type}}">
                            </div>
                            <div class="col-md-1">
                                <input type="number" class="form-control" name="price[]" id="price" placeholder="Enter Price" value="{{$seatdata->price}}">
                            </div>
                              @if($loop->index==0)
                                <div class="col-md-1 add_div">
                                    <button type="button" class="btn btn-primary add">+</button>
                                </div>
                              @else
                                <div class="col-md-1 add_div">
                                  <button type="button" class="btn btn-primary add">+</button>
                                  <button type="button" class="btn btn-primary remove">-</button>
                                </div>
                              @endif  
                            </div>
                          @endforeach

                    <button type="submit" class="btn btn-primary">Update</button>
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
  });
</script>
@endsection
                
