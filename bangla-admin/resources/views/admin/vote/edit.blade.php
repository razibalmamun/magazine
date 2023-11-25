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
                    <li class="breadcrumb-item active">Vote</li>
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
                        <h3 class="card-title">Edit New Vote</h3>
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
                        action="{{ Url('/admin/vote/store') }}">
                        @csrf
                        <input name="id" type="hidden" value="{{ $vote->id }}" />
                        <div class="card-body">
                            <div class="form-group">
                                <label for="details">Topic</label>
                                <textarea name="description" class="form-control">{{ $vote->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>

                            <div class="form-group">
                                <label for="order">Order</label>
                                <input type="number" min="1" name="order" value="{{ $vote->order }}" class="form-control"
                                    id="order" placeholder="Enter order">
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="datetime-local" name="date" class="form-control"
                                    value="{{ date('Y-m-d\TH:i:s', strtotime($vote->date)) }}" id="date"
                                    placeholder="Date Time">
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
