@extends('admin.layout.master')
@section('title')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add New Category</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">News</li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@endsection()
@section('body')
<?php
if($category->name == 'লাইফস্টাইল' || $category->name == 'চাকরি' || $category->name == 'বিনোদন' || $category->name == 'প্রচ্ছদ'){ ?>
    <script type="text/javascript">
        window.location = "{{ url('/admin/news/category/list') }}";
    </script>
<?php exit; } ?>
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Create New Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" method="POST" action="{{Url('/admin/news/category/update')}}">
                @csrf
                <input type="hidden" name="id" value="<?= $category->id; ?>" />
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?= $category->name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" min="1" name="order" class="form-control" id="order" value="<?= $category->order; ?>" placeholder="Category Order">
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
