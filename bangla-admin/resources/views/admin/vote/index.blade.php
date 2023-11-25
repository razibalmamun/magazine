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
                        <h3 class="card-title">All Votes lists</h3>
                        <a class="btn btn-primary float-right listbutton" href="{{ Url('/admin/vote/create') }}">Add New
                            Vote</a>
                    </div>
                    <div class="p-3">
                        <table id="categorylist" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Details</th>
                                    <th>Yes</th>
                                    <th>No</th>
                                    <th>No Comments</th>
                                    <th>Order</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($votes as $vote){ ?>
                                <tr>
                                    <td><?= $vote->description ?></td>
                                    <td><?= $vote->yes ?></td>
                                    <td><?= $vote->no ?></td>
                                    <td><?= $vote->no_comments ?></td>
                                    <td><?= $vote->order ?></td>
                                    <td>
                                        @if ($vote->image)
                                            <img src="<?= $vote->image ?>" height="100" width="100" />
                                        @endif
                                    </td>
                                    <td>
                                        @if ($vote->status)
                                            <a class="btn btn-danger mt-3"
                                                href="{{ Url('/admin/vote/deactivate', $vote->id) }}"><i
                                                    class="fas fa-folder fa-fw"></i>Deactivate</a>
                                        @else
                                            <a class="btn btn-info mt-3"
                                                href="{{ Url('/admin/vote/activate', $vote->id) }}"><i
                                                    class="fas fa-folder fa-fw"></i>Activate</a>
                                        @endif
                                        <a class="btn btn-success mt-3" href="{{ Url('/admin/vote/edit', $vote->id) }}"><i
                                                class="fas fa-edit fa-fw"></i></a>
                                        <a class="btn btn-danger mt-3"
                                            href="{{ Url('/admin/vote/delete', $vote->id) }}"><i
                                                class="fas fa-trash fa-fw"></i></a>
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
            $('#categorylist').DataTable({
                "pageLength": 10,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "order": false;
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection()
