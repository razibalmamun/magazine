@extends('admin.layout.master')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection()
@section('body')
<div class="container-fluid listpage">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Opinion lists</h3>
                <a class="btn btn-primary float-right listbutton" href="{{Url('/admin/news/image/index')}}">Add New Opinion</a>
            </div>
            <div class="p-3">
                <table id="categorylist" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Short Description</th>
                            <th>Image</th>
                            <th>Date Time</th>
                            <th>Sort Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($opinionList as $opinion){ ?>
                            <tr>
                                <td><?= $opinion->id ?></td>
                                <td><?= $opinion->title ?></td>
                                <td><?= $opinion->description ?></td>
                                <td><?= $opinion->short_description ?></td>
                                <td>
                                    <img src="<?= str_replace('/public', '', $opinion->image_file);?>" width="320" height="280" alt="">
                                </td>
                                <td><?= date('d-m-Y H:i:s', strtotime($opinion->date)); ?></td>
                                <td><?= $opinion->order; ?></td>
                                <td>
                                    <a class="btn btn-primary mt-3" href="{{Url('/admin/opinion/view', $opinion->id)}}"><i class="fas fa-eye fa-fw"></i></a>
                                    <a class="btn btn-success mt-3" href="{{Url('/admin/opinion/edit', $opinion->id)}}"><i class="fas fa-edit fa-fw"></i></a>
                                    <a class="btn btn-danger mt-3" href="{{Url('/admin/opinion/delete', $opinion->id)}}"><i class="fas fa-trash fa-fw"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection()
@section('scripts')
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $('#categorylist').DataTable({
        "pageLength": 10,
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection()
