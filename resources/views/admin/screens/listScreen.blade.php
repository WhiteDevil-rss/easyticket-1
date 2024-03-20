@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Theatre Screens</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Screens</li>
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
              <h3 class="card-title">List of all theatre screens</h3>
              <a class="btn btn-primary float-right" name="add_new" href="{{route('admin.screen.add')}}">Add New Screen</a>
            </div>
            <!-- /.card-header -->            
            <div class="card-body">
              {{-- add filter option in datatable for theatre --}}

              <table id="screen_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Screen</th>
                    <th>Theatre</th>
                    <th>Capacity</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($screens as $screen)
                    <tr>
                        <td>{{$screen->screen_id}}</td>
                        <td>{{$screen->screen_name}}</td>
                        <td>{{$screen->threatre_name}}</td>
                        <td>{{$screen->capacity}}</td>
                        <td>{{$screen->created_at}}</td>
                        <td>
                        <a href="{{route('admin.screen.edit', $screen->screen_id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        {{-- a href confirm message before delete --}}
                        <a href="{{route('admin.screen.delete', $screen->screen_id)}}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                  @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Screen</th>
                    <th>Theatre</th>
                    <th>Capacity</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
              </tfoot>
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
    var screenDatatable = $("#screen_list").DataTable({
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
