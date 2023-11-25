@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endsection()
@section('title')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit CMS Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">CMS</li>
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
                        <h3 class="card-title">Edit CMS Page</h3>
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
                    <form id="quickForm" method="POST" action="{{ Url('/admin/cms/update') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{$cms->id}}">
                                <label for="contact_info">Contact Information</label>
                                <input type="text" disabled value="{{ $cms->type }}" name="contact_info"
                                    class="form-control" id="contact_info" placeholder="Contact Information">
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" id="content">{!! $cms->content !!}</textarea>
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
