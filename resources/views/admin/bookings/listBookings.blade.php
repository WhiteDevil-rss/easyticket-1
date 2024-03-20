@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Bookings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Bookings</li>
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
              <h3 class="card-title">Ticket Bookings</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="booking_lists" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>User</th>
                        <th>Movie</th>
                        <th>Screen</th>
                        <th>Seats</th>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                        <th>Booking Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->ticket_id }}</td>
                        <td>{{ $booking->user_name}}</td>
                        <td>{{ $booking->movie_name }}</td>
                        <td>{{ $booking->screen_name }}</td>
                        <td>{{ $booking->seat_number }}</td>
                        <td>{{ $booking->show_date }}</td>
                        <td>{{ Carbon\Carbon::parse($booking->start_time)->format('H:i a') }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                        <a href="{{ route('admin.bookings.edit', $booking->ticket_id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('admin.bookings.delete', $booking->ticket_id) }}" onclick="return confirm('Are you sure you want to delete the booking {{ $booking->ticket_id }} ?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
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
    $("#booking_lists").DataTable({
      initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var column = this;
                    var select = $('<br><select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.header()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
 
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
 
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                });
        },
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
