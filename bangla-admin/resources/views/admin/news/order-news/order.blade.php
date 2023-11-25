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
                    <div class="form" style="padding: 20px;">
                        <form id="order-form">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <select name="category_id" class="form-control" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select name="type" id="type" class="form-control" id="type" required>
                                        <option value="">Select Type</option>
                                        <option value="general">General news</option>
                                        <option value="lead_news">Lead news</option>
                                        <option value="sub_lead_news">Sub lead news</option>
                                        <option value="second_lead">Second lead</option>
                                        <option value="side_bar_news">Side bar news</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input class="form-control" type="date" name="date" id="date" />
                                </div>
                                <div class="col-2">
                                    <input type="submit" class="btn" value="Submit" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="list" id="list" style="padding: 20px;">
                        @if (isset($list))
                            @foreach ($list as $item)
                            @endforeach
                        @endif
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
    <script src="{{ asset('assets/dist/js/notify.js') }}"></script>
    <!-- Page specific script -->
    <script>
        function btn_click(newsId) {
            let id = newsId;
            let order = $('#input_' + id).val();

            console.log(order)

            $.ajax({
                url: "{{ URL('admin/news/orderUpdate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    order: order,
                },
                success: function(response) {
                    $.notify(response.message, "success");
                }
            });
        }

        $('#order-form').on('submit', function(e) {
            e.preventDefault();
            let category_id = $('#category_id').val();
            let type = $('#type').val();
            let date = $('#date').val();

            $.ajax({
                url: "{{ URL('admin/news/order-news-store') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    category_id: category_id,
                    type: type,
                    date: date,
                },
                success: function(response) {
                    if (response) {
                        $('#list').empty();
                        $.each(response, function(key, item) {
                            $('#list').append('<div class="news-item row">' +
                                '<div class="col-4">' + item.title + '</div>' +
                                '<div class="col-2">' + item.type + '</div>' +
                                '<div class="col-2">' + item.date + '(Y-m-d)</div>' +
                                '<div class="col-2">' +
                                '<input type="text" id="input_' + item.id + '" value="' +
                                item
                                .order +
                                '" class="form-control">' +
                                '</div>' +
                                '<div class="col-2"><button class="btn" onclick="btn_click(' +
                                item.id + ');">Update</button></div>' +
                                '</div><hr>');

                        });
                    }
                }
            });
        })
    </script>
@endsection()
