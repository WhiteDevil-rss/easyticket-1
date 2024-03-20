@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Bookings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Bookings</li>
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
              <h3 class="card-title">Edit Ticket Bookings</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('admin.bookings.update', $ticket->id) }}">
                    @csrf               
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required {{ $ticket->status == 'completed' ? 'disabled' : '' }}>
                            <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $ticket->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $ticket->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="user_id">User ID</label>
                        <input id="user_id" type="text" name="user_id" class="form-control" value="{{ $ticket->user_id }}" disabled>
                    </div>
                
                    <div class="form-group">
                        <label for="showtime_id">Showtime ID</label>
                        <input id="showtime_id" type="text" name="showtime_id" class="form-control" value="{{ $ticket->showtime_id }}" disabled>
                    </div>
                
                    <div class="form-group">
                        <label for="movie_id">Movie ID</label>
                        <input id="movie_id" type="text" name="movie_id" class="form-control" value="{{ $ticket->movie_id }}" disabled>
                    </div>
                
                    <div class="form-group">
                        <label for="payment_id">Payment ID</label>
                        <input id="payment_id" type="text" name="payment_id" class="form-control" value="{{ $ticket->payment_id }}" disabled>
                    </div>
                
                    <div class="form-group">
                        <label for="seat_number">Seat Number</label>
                        <input id="seat_number" type="text" name="seat_number" class="form-control" value="{{ $ticket->seat_number }}" disabled>
                    </div>
                
                    <div class="form-group">
                        <label for="show_date">Show Date</label>
                        <input id="show_date" type="text" name="show_date" class="form-control" value="{{ $ticket->show_date }}" disabled>
                    </div>
                
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input id="price" type="text" name="price" class="form-control" value="{{ $ticket->price }}" disabled>
                    </div>
                
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
</script>
@endsection
