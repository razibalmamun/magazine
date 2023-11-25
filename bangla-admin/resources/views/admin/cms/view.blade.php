@extends('admin.layout.master')
@section('title')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Opinion Details</h1>
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
                        <h3 class="card-title">Page Details</h3>
                    </div>
                    <div class="category-details ml-3 mt-3">
                        <h5>Page type</h5>
                        <hr />
                        <p>{{$cms->type}}</p>
                    </div>
                    <div class="category-details ml-3 mt-3">
                        {!! $cms->content !!}
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection()
