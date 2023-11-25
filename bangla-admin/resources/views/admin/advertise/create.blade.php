@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endsection()
@section('title')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add New Advertise</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Advertise</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection()
@section('body')

    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create New Advertise</h3>
                    </div>
                    @if ($errors->any())
                        <ul class="mt-3">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm" method="POST" action="{{ Url('/admin/advertise/store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="contact_info">Advertise type</label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_1"
                                                value="layout_top_add">
                                            <label class="form-check-label" for="type_1">
                                                layout top add
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_2"
                                                value="layout_modal_add">
                                            <label class="form-check-label" for="type_2">
                                                layout modal add
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_3"
                                                value="layout_fixed_bottom_add">
                                            <label class="form-check-label" for="type_3">
                                                layout fixed bottom add
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_4"
                                                value="home_lead_left_add">
                                            <label class="form-check-label" for="type_4">
                                                home lead left add
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_5"
                                                value="home_lead_right_add">
                                            <label class="form-check-label" for="type_5">
                                                home lead right add
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_6"
                                                value="home_second_lead_left_add">
                                            <label class="form-check-label" for="type_6">
                                                home second lead left add
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_7"
                                                value="home_middle_big_add">
                                            <label class="form-check-label" for="type_7">
                                                home middle big add
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_8"
                                                value="home_sports_right_add">
                                            <label class="form-check-label" for="type_8">
                                                home sports right add
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_9"
                                                value="single_news_page_right_add">
                                            <label class="form-check-label" for="type_9">
                                                single news page right add
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_10"
                                                value="category_page_right_add">
                                            <label class="form-check-label" for="type_10">
                                                category page right add
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_11"
                                                value="loacal_news_right_add">
                                            <label class="form-check-label" for="type_11">
                                                loacal news right add
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_12"
                                                value="extra_add_1">
                                            <label class="form-check-label" for="type_12">
                                                extra add 1
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_13"
                                                value="extra_add_2">
                                            <label class="form-check-label" for="type_13">
                                                extra add 2
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type_14"
                                                value="extra_add_3">
                                            <label class="form-check-label" for="type_14">
                                                extra add 3
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" id="content"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="d-block" name="image" id="image" />
                            </div>
                            <div class="form-group">
                                <label for="image_link">Image Link</label>
                                <input type="text" class="form-control" name="image_link" id="image_link" />
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="active" value="checked"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Mark this as active
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
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
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('#content').summernote()
    </script>
@endsection()
