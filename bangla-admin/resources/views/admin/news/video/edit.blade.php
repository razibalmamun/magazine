@extends('admin.layout.master')
@section('title')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add New Video</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">News</li>
                <li class="breadcrumb-item active">Video</li>
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
            <h3 class="card-title">Create New Video Content</h3>
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
            <form id="quickForm" method="POST" action="{{Url('/admin/news/video/update')}}" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="id" value="<?= $video->id; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="video_link">Video Link</label>
                        <input type="text" name="video_link" class="form-control" id="video_link" value="<?= $video->video_link; ?>">
                    </div>
                    <div class="form-group">
                        <label for="video_thumbnail">Video Thumbnail</label>
                        <input type="file" name="video_thumbnail" class="form-control" id="video_thumbnail" value="<?= $video->video_thumbnail; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="date_time">Date Time</label>
                        <input type="datetime-local" name="date_time" class="form-control" id="date_time" value="<?= $video->date_time; ?>">
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
