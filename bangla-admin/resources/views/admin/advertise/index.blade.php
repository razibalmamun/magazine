@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection()
@section('body')
    <div class="container-fluid listpage">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Advertise</h3>
                        <a class="btn btn-primary float-right listbutton" href="{{ Url('/admin/advertise/create') }}">Add
                            New</a>
                    </div>
                    <div class="p-3">
                        <table id="contactList" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($advertise as $item){ ?>
                                <tr>
                                    <td><?= $item->type ?></td>
                                    <td>{!! $item->content !!} </td>
                                    @if ($item->image)
                                        <td><img src="<?= $item->image ?>" height="100" width="100" /></td>
                                    @else
                                        <td><span class="badge badge-danger">No Image</span></td>
                                    @endif
                                    @if ($item->status)
                                        <td><span class="badge badge-success">Yes</span></td>
                                    @else
                                        <td><span class="badge badge-danger">No</span></td>
                                    @endif
                                    <td>
                                        <a class="btn btn-info mt-3"
                                            href="{{ Url('/admin/advertise/edit', $item->id) }}"><i
                                                class="fas fa-pen fa-fw"></i>Edit</a>
                                        @if (!$item->status)
                                            <a class="btn btn-info mt-3"
                                                href="{{ Url('/admin/advertise/active', $item->id) }}"><i
                                                    class="fas fa-pen fa-fw"></i>Activate</a>
                                        @endif
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
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#contactList').DataTable({
                "pageLength": 10,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "order": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection()
