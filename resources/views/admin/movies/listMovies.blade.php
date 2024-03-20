@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Movies</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Movies</li>
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
              <h3 class="card-title">List of all theatres</h3>
              <a class="btn btn-primary float-right" name="add_new" href="{{route('admin.movies.add')}}">Add Movie</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="movie_lists" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Movie Name</th>
                    <th>Image</th>
                    <th>Rating</th>
                    <th>Duration</th>
                    <th>Release Date</th>
                    <th>Genre</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($movies as $movie)
                    <tr>
                        <td>{{$movie->id}}</td>
                        <td>{{$movie->title}}</td>
                        <td><img src="{{URL('public/frontend/images/movie/'.$movie->image)}}" class="responsive p-1 " style="height:200px;width:150px" /></td>
                        <td>{{$movie->rating}}</td>
                        <td>{{$movie->duration}}</td>
                        <td>{{$movie->release_date}}</td>
                        <td>{{$movie->genre}}</td>
                        <td>
                        <a href="{{route('admin.movies.edit', $movie->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="{{route('admin.movies.delete', $movie->id)}}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
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
    $("#movie_lists").DataTable({
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
