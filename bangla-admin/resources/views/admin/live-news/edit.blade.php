@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/codemirror/theme/monokai.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/simplemde/simplemde.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endsection
@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Live News</h3>
                    </div>
                    @if ($errors->any())
                        <ul class="mt-3">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form id="quickForm" method="post" action="{{ URL('admin/news/live-news/update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="news_id" value="{{ $liveNews->news_id }}" />
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $liveNews->title }}" id="title" placeholder="Enter title">
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="date">Date Time</label>
                                    <input type="datetime-local" name="date" value="{{ date('Y-m-d\TH:i:s', strtotime($liveNews->date)) }}" class="form-control" id="date"
                                        placeholder="Date Time">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summernote">Details</label>
                                <textarea id="details" name="details">{!! $liveNews->details !!}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script>
        $('#details').summernote()
    </script>
@endsection