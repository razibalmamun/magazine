@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.min.css')}}">
@endsection()
@section('title')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add New Seo</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Seo</li>
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
            <h3 class="card-title">Create New Seo</h3>
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
            <form id="quickForm" method="POST" action="{{Url('/admin/seo/store')}}" enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                    <input name="id" type="hidden" value="{{$seo->id}}" />
                    <div class="form-group">
                        <label for="title">Page Name</label>
                        <select name="page_name" class="form-control">
                            <option >Select one option</option>
                            <option value="home" <?php if($seo->page_name == "home"){echo "selected";} ?>>Home</option>
                            <option value="about_us" <?php if($seo->page_name == "about_us"){echo "selected";} ?>>About us</option>
                            <option value="communication" <?php if($seo->page_name == "communication"){echo "selected";} ?>>Communication</option>
                            <option value="advertise" <?php if($seo->page_name == "advertise"){echo "selected";} ?>>Advertise </option>
                            <option value="terms_and_condition" <?php if($seo->page_name == "terms_and_condition"){echo "selected";} ?>>Terms and condition</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <textarea id="title" class="form-control" name="title">{{$seo->title}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" class="form-control" name="description">{{$seo->description}}</textarea>
                        <!-- <textarea name="description" class="form-control" id="description"></textarea> -->
                    </div>
                    <div class="form-group">
                        <label for="share_title">Share Title</label>
                        <textarea name="share_title" class="form-control" id="share_title">{{$seo->share_title}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="page_img">Image</label>
                        <input type="file" name="page_img" class="form-control" id="page_img" />
                    </div>
                    <div class="form-group">
                        <label for="keywords">Keywords</label>
                        <textarea name="keywords" class="form-control" id="keywords">{{$seo->keywords}}</textarea>
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
@endsection()
