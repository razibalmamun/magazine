@extends('admin.layout.master')
@section('title')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add New Vote</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Trending</li>
                    <li class="breadcrumb-item active">Details</li>
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
                        <h3 class="card-title">Create Trending Details</h3>
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
                    <form enctype="multipart/form-data" id="quickForm" method="POST"
                        action="{{ Url('/admin/news/keyword/trending-details-store') }}">
                        @csrf
                        <input type="hidden" value="{{ $trndingDetails->id ?? '' }}" name="id">
                        <input type="hidden" value="{{ $id }}" name="trending_id">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="details">Details</label>
                                <textarea name="details" class="form-control">{{ $trndingDetails->details ?? '' }}</textarea>
                            </div>
                            @if (isset($trndingDetails->image))
                                <div class="form-group">
                                    <img src="{{ $trndingDetails->image ?? '' }}" height="150" width="150" />
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
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
