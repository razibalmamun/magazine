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
                <li class="breadcrumb-item active">আমরা</li>
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
            <h3 class="card-title">Create Member</h3>
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
            <form id="quickForm" method="POST" action="{{Url('/admin/weare/store')}}" enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" name="name" class="form-control" id="title" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea id="details" class="form-control" name="details" >Place <em>some</em> <u>text</u> <strong>here</strong></textarea>
                        <!-- <textarea name="description" class="form-control" id="description"></textarea> -->
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control" id="image" />
                    </div>

                    <div class="form-group">
                        <label for="image">Division</label>
                        <select name="div_id" class="form-control">
                            <option value="">--Select one--</option>
                            @foreach($divisions as $division)
                            <option value="{{$division->id}}">{{$division->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Designation</label>
                        <select name="designation" class="form-control">
                            <option value="">--Select one--</option>
                            @foreach($designations as $designation)
                            <option name="{{$designation->name}}">{{$designation->name}}</option>
                            @endforeach
                        </select>
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
    $('#details').summernote()
</script>
@endsection()
