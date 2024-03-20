@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Theatres</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Theatres</li>
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
              <a href="{{route('admin.theatres.add')}}" class="btn btn-primary float-right">Add</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="user_lists" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Theatre Name</th>
                    <th>Phone No</th>
                    <th>City Name</th>
                    <th>Address</th>
                    <th>Is Active</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($theatres as $theatre)
                    <tr>
                        <td>{{$theatre->theater_id}}</td>
                        <td>{{$theatre->name}}</td>
                        <td>{{$theatre->phone_no}}</td>
                        <td>{{$theatre->city_name}}</td>
                        <td>{{$theatre->address}}</td>
                        <td>
                          @if($theatre->is_active == 1)
                          <span class="badge badge-success">Active</span>
                          @else
                          <span class="badge badge-danger">Inactive</span>
                          @endif  
                        </td>
                        <td>{{$theatre->created_at}}</td>
                        <td>
                        <a href="{{route('admin.theatres.edit', $theatre->theater_id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="{{route('admin.theatres.delete', $theatre->theater_id)}}" onclick="return confirm('Are you sure you want to delete theatres {{$theatre->name}}? ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
    $("#user_lists").DataTable({
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
