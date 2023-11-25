@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.min.css')}}">
@endsection()
@section('title')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add New Opinion</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">News</li>
                <li class="breadcrumb-item active">Opinion</li>
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
            <h3 class="card-title">Create New Opinion</h3>
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
            <form id="quickForm" method="POST" action="{{Url('/admin/opinion/create')}}" enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" class="form-control" name="description">Place <em>some</em> <u>text</u> <strong>here</strong></textarea>
                        <!-- <textarea name="description" class="form-control" id="description"></textarea> -->
                    </div>
                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <textarea name="short_description" class="form-control" id="short_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_file">Image</label>
                        <input type="file" name="image_file" class="form-control" id="image_file" />
                    </div>
                    <div class="form-group">
                        <label for="date">Date Time</label>
                        <input type="datetime-local" name="date" class="form-control" id="date" placeholder="Date Time">
                    </div>
                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" name="order" class="form-control" id="order" placeholder="Sort Order">
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
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $('#description').summernote()
</script>
@endsection()
