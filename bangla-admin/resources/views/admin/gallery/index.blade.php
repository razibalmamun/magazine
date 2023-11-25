@extends('admin.layout.master')
@section('title')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Image</h1>
            </div>
            <div class="col-sm-3">
                <a class="btn btn-primary" href="{{URL('admin/gallery/create')}}">Add New</a>
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Gallery</li>
                    <li class="breadcrumb-item active">Image</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection()
@section('body')
    <div class="row" style="margin-left: 5px">
        @foreach ($galleries as $item)
            <div class="col-2" style="margin-right: 10px; margin-bottom: 10px;">
                <img height="250" width="200" style="display: block" src="{{ $item->image_file }}" />
                <input disabled type="text" style="margin-top: 5px" id="url-{{ $item->id }}" value="{{ $item->image_file }}">
                <button class="btn btn-info" onclick="copyURL('{{ $item->id }}')" style="margin-top: 5px">
                    Copy URL
                </button>
            </div>
        @endforeach
    </div>
    <div class="paginate" style="margin-top: 15px;">
        {{ $galleries->links() }}
    </div>
@endsection()
@section('scripts')
    <script>
        function copyURL(id) {
            /* Get the text field */
            var copyText = document.getElementById("url-" + id);

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            /* Alert the copied text */
            Swal.fire("Copied the URL: " + copyText.value)
        }
    </script>
@endsection()
