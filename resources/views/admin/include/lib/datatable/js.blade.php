<!-- DataTables -->
<script src="{{ url('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('admin/dist/js/demo.js') }}"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({ "pageLength": 100 });
    $('#example2').DataTable({
      "paging": true,
      "pageLength": 100,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
    });
  });
</script>