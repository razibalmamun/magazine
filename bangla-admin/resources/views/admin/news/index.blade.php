@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection()
@section('body')
    <style>
        td {
            padding-top: 0 !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="p-3">
                        <table id="newsList" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">Posted By</th>
                                    <th width="20%">Title</th>
                                    <th width="10%">Representative</th>
                                    <th width="20%">Category</th>
                                    <th width="5%">Order</th>
                                    <th width="10%">Type</th>
                                    <th width="10%">Date and Time</th>
                                    <th width="5%">Published</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $item)
                                    <tr>
                                        <td>{{ $item->user ? $item->user->name : '' }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->details->representative ?? '' }}</td>
                                        <td><?php foreach ($item->category as $cat) {?>
                                            <span class="badge badge-primary"
                                                style="margin-right: 20px;"><?= $cat->category->name ?></span>
                                            <?php } ?>
                                        </td>
                                        <td>{{ $item->order }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>
                                            @if ($item->published)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary mt-3"
                                                href="{{ Url('/admin/news/view', $item->id) }}"><i
                                                    class="fas fa-folder"></i> View</a>
                                            <a class="btn btn-success mt-3"
                                                href="{{ Url('/admin/news/edit/' . $item->id) }}"><i
                                                    class="fas fa-edit"></i> Edit</a>
                                            <a class="btn btn-danger mt-3"
                                                onclick="event.preventDefault();deleteConfirmation('{{ $item->id }}');"><i
                                                    class="fas fa-trash"></i> Delete</a>
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ Url('/admin/news/delete', $item->id) }}" method="POST"
                                                class="d-none">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            @if (in_array(auth()->user()->role, ['admin', 'publisher', 'editor', 'desk_reporter']) &&
                                                $item->published == 0 &&
                                                $item->proofreader != 1)
                                                <a class="btn btn-success mt-3"
                                                    href="{{ Url('/admin/news/publish', $item->id) }}"><i
                                                        class="fas fa-eye"></i> Publish</a></a>
                                            @endif
                                            @if (in_array(auth()->user()->role, ['admin', 'publisher', 'editor', 'desk_reporter']) &&
                                                $item->published == 0 &&
                                                $item->proofreader == 0)
                                                <a class="btn btn-info mt-3"
                                                    href="{{ Url('/admin/news/proofreader', $item->id) }}"><i
                                                        class="fas fa-eye"></i> Proofreader</a></a>
                                            @endif
                                            @if ($item->proofreader == 1)
                                                <a class="btn btn-info mt-3"> Pending Proofreader</a></a>
                                            @endif
                                            @if ($item->proofreader == 2)
                                                <a class="btn btn-success mt-3">Complete Proofreader</a></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
        function deleteConfirmation(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
        
        $(function() {
            $('#newsList').DataTable({
                "pageLength": 10,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                'order': false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection()
