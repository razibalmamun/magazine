@extends('admin.layout.master')
@section('title')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Division</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Division</li>
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
            <h3 class="card-title">Edit Division</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" method="POST" action="{{Url('/admin/division/update')}}">
                @csrf
                <input type="hidden" name="id" value="<?= $division->id; ?>" />
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Division</label>
                        <input type="text" name="name" class="form-control" required id="exampleInputEmail1" value="<?= $division->name; ?>">
                    </div>
                    <div class="form-group">
                        <p class="font-weight-bold">Order</p>
                        <input name="order" min="1" type="number" value="{{$division->order;}}" class="form-control" required />
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
