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
                        <h3 class="card-title">All Keyword lists</h3>
                        <a class="btn btn-primary float-right listbutton" href="{{ Url('/admin/news/keyword/index') }}">Add
                            New Keyword</a>
                    </div>
                    <div class="p-3">
                        <table id="keywordlist" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Keyword Name</th>
                                    <th>Is Trending</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($keywordlist as $keyword){ ?>
                                <tr>
                                    <td><?= $keyword->name ?></td>
                                    <td>
                                        @if ($keyword->trending)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary mt-3"
                                            href="{{ Url('/admin/news/keyword/view', $keyword->id) }}"><i
                                                class="fas fa-eye fa-fw"></i>View</a>
                                        <a class="btn btn-success mt-3"
                                            href="{{ Url('/admin/news/keyword/edit', $keyword->id) }}"><i
                                                class="fas fa-edit fa-fw"></i>Edit</a>
                                        <a class="btn btn-danger mt-3"
                                            href="{{ Url('/admin/news/keyword/delete', $keyword->id) }}"><i
                                                class="fas fa-trash fa-fw"></i>Delete</a>
                                        @if (!$keyword->trending)
                                            <a class="btn btn-info mt-3"
                                                href="{{ Url('/admin/news/keyword/make-trending', $keyword->id) }}"><i
                                                    class="fas fa-folder fa-fw"></i>Make trending</a>
                                        @else
                                            <a class="btn btn-danger mt-3"
                                                href="{{ Url('/admin/news/keyword/remove-trending', $keyword->id) }}"><i
                                                    class="fas fa-folder fa-fw"></i>Remove trending</a>
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
            $('#keywordlist').DataTable({
                "pageLength": 10,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "info": true,
                'order': false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection()
