@extends('admin.layout.master')
@section('title')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Video Details</h1>
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
                        <h3 class="card-title">Video Details</h3>
                    </div>
                    <div class="category-details ml-3 mt-3">
                        <h5>Video</h5>
                        <hr />
                        <p><iframe width="320" height="280" src="<?= $video->video_link ?>" frameborder="0"
                                allowfullscreen></iframe></p>
                    </div>
                    <div class="category-details ml-3">
                        <h5>Video Thumbnail</h5>
                        <hr />
                        <p><img src="{{ $video->video_thumbnail }}" width="320" height="280" alt=""></p>
                    </div>
                    <div class="category-details ml-3">
                        <h5>Date Time</h5>
                        <hr />
                        <p><?= date('d-m-Y H:i:s', strtotime($video->date_time)) ?></p>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection()
