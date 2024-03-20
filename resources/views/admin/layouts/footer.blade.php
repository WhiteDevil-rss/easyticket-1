{{-- {{dd(session()->all())}} --}}
{{-- add toastr common message --}}
@if(Session::has('success'))
<script>
  //toast message
  toastr.success("{{Session::get('success')}}");
</script>
@endif
@if(Session::has('error'))
<script>
    toastr.error("{{Session::get('error')}}");
</script>
@endif
@if(Session::has('warning'))
<script>
    toastr.warning("{{Session::get('warning')}}");
</script>
@endif
@if(Session::has('info'))
<script>
    toastr.info("{{Session::get('info')}}");
</script>
@endif
@if(Session::has('message'))
<script>
    toastr.info("{{Session::get('message')}}");
</script>
@endif


<!-- Main Footer -->
 <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="{{env('APP_URL')}}">{{env('APP_NAME')}}</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Bootstrap -->
<script src="{{url('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('public/admin/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{url('public/admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{url('public/admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{url('public/admin/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{url('public/admin/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('public/admin/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{url('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('public/admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('public/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('public/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('public/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('public/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('public/admin/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('public/admin/js/pages/dashboard2.js')}}"></script>
</body>
</html>