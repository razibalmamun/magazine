@extends('admin.layout.master')
@section('title')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add New Sub Category</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">News</li>
                <li class="breadcrumb-item active">Sub Category</li>
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
            <h3 class="card-title">Create New Sub Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" method="POST" action="{{Url('/admin/news/subcategory/update')}}">
                @csrf
                <input type="hidden" name="id" value="<?= $subcategory->id; ?>" />
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sub Category Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?= $subcategory->name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Parent Category</label>
                        <select class="form-control" name="category_id">
                            <?php foreach($categorylist as $category){ ?>
                                <?php if($subcategory->category_id == $category->id){ ?>
                                <option value="<?= $category->id; ?>" selected><?= $category->name; ?></option>
                                <?php } else { ?>
                                <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                                <?php } ?>
                            <?php } ?>
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
