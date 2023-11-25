@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection()
@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All জাতীয় news lists</h3>
                    </div>
                    <div class="p-3">
                        <table id="categorylist" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Sort Description</th>
                                <th>Order</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Date and Time</th>
                                {{--                                <th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $item)
                                <tr>
                                    <td>{{$item->title}}</td>
                                    <td>{!! $item->sort_description !!}</td>
                                    <td>{{$item->order}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->category->name}} </td>
                                    <td>{{$item->date}}</td>
                                    {{--                                <td>--}}
                                    {{--                                    <a class="btn btn-primary mt-3" href="{{Url('/admin/news/category/view', $category->id)}}"><i class="fas fa-eye fa-fw"></i></a>--}}
                                    {{--                                    <a class="btn btn-success mt-3" href="{{Url('/admin/news/category/edit', $category->id)}}"><i class="fas fa-edit fa-fw"></i></a>--}}
                                    {{--                                    <a class="btn btn-danger mt-3" href="{{Url('/admin/news/category/delete', $category->id)}}"><i class="fas fa-trash fa-fw"></i></a>--}}
                                    {{--                                </td>--}}
                                </tr>

                            @endforeach
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
