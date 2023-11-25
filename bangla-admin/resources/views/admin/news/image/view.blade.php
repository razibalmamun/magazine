@extends('admin.layout.master')
@section('title')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Image Details</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">News</li>
                <li class="breadcrumb-item active">Image</li>
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
                    <h3 class="card-title">Image Details</h3>
                </div>
                <div class="category-details ml-3 mt-3">
                    <h5>Title</h5>
                    <hr />
                    <p><?= $image->title; ?></p>
                </div>
                <div class="category-details ml-3">
                    <h5>Image</h5>
                    <hr />
                    <p><img src="<?= str_replace('/public', '', $image->image_file);?>" width="320" height="280" alt=""></p>
                </div>
                <div class="category-details ml-3">
                    <h5>Date Time</h5>
                    <hr />
                    <p><?= date('d-m-Y H:i:s', strtotime($image->date));; ?></p>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection()
