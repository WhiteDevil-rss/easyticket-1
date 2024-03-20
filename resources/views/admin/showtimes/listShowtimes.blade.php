@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Showtimes</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Showtimes</li>
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
              <h3 class="card-title">List of all showtimes</h3>
              <a class="btn btn-primary float-right" name="add_new" href="{{route('admin.showtimes.add')}}">Add New Showtime</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="showtimes_lists" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Movie</th>
                  <th>Screen</th>
                  <th>Theatre Name</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Created At</th>
                  <th>Active</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($showtimes as $showtime)
                    <tr>
                      <td>{{$showtime->showtime_id}}</td>
                      <td>{{$showtime->movie_name}}</td>
                      <td>{{$showtime->screen_name}}</td>
                      <td>{{$showtime->theater_name}}</td>
                      <td>{{Carbon\Carbon::parse($showtime->start_time)->format('H:i')}}</td>
                      <td>{{Carbon\Carbon::parse($showtime->end_time)->format('H:i')}}</td>
                      <td>{{$showtime->created_at}}</td>
                      <td>
                        @if($showtime->is_active == 1)
                        <span class="badge badge-success">Active</span>
                        @else
                        <span class="badge badge-danger">Inactive</span>
                        @endif  
                      </td>
                      <td>
                        <a href="{{route('admin.showtime.edit', ['id'=> $showtime->showtime_id])}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="{{route('admin.showtime.delete', ['id' => $showtime->showtime_id])}}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
    $("#showtimes_lists").DataTable({
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
