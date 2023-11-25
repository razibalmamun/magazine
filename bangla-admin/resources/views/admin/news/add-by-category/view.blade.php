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
                <div class="card card-primary p-4">
                    @if ($news->published)
                        <span class="badge badge-success col-2 d-block p-2">News is published</span>
                    @else
                        <span class="badge badge-danger col-2 d-block p-2">News isn't published</span>
                    @endif

                    <div class="item pt-3">
                        <p class="text-md-left font-weight-bold">Title</p>
                        <textarea disabled class="form-control">{{ $news->title }}</textarea>
                    </div>
                    <div class="pt-3" style="max-width:200px; height:auto;">
                        <img src="{{ $news->image }}" class="img-thumbnail">
                    </div>
                    <div class="item pt-3">
                        <p class="text-md-left font-weight-bold">Sort description</p>
                        <div>
                            {!! $news->sort_description !!}
                        </div>
                    </div>
                    <div class="item pt-3">
                        <p class="text-md-left font-weight-bold">Details</p>
                        <div>
                            {!! $news->details->details ?? '' !!}
                        </div>
                    </div>
                    <div class="item pt-3">
                        <p class="text-md-left font-weight-bold">Ticker</p>
                        <div>
                            {!! $news->details->ticker ?? '' !!}
                        </div>
                    </div>
                    <div class="item pt-3">
                        <p class="text-md-left font-weight-bold">Shoulder</p>
                        <div>
                            {!! $news->details->shoulder ?? '' !!}
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="list-group pt-2 col-6">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Category</h5>
                                </div>
                                <p class="mb-1">
                                    @foreach ($categories as $category)
                                        <span class="mr-2">{{ $category->category->name }}</span>
                                    @endforeach
                                </p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Sub-Category</h5>
                                </div>
                                <p class="mb-1">
                                    @foreach ($subCategories as $subCategory)
                                        <span class="mr-2">{{ $subCategory->subCategory->name }}</span>
                                    @endforeach
                                </p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Order </h5>
                                </div>
                                <p class="mb-1">{{ $news->order }}</p>
                            </a>
                        </div>
                        <div class="list-group pt-2 col-6">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Date</h5>
                                </div>
                                <p class="mb-1">{{ date('Y-m-d\TH:i:s', strtotime($news->date)) }}</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Type</h5>
                                </div>
                                <p class="mb-1">{{ ucwords(str_replace('_', ' ', $news->type)) }}</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Representative</h5>
                                </div>
                                <p class="mb-1">{{ $news->details->representative ?? '' }}</p>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="list-group pt-2 col-4">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Division</h5>
                                </div>
                                <p class="mb-1">{{ $news->region->divisionInfo->name ?? ' ' }}</p>
                            </a>
                        </div>
                        <div class="list-group pt-2 col-4">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">District</h5>
                                </div>
                                <p class="mb-1">{{ $news->region->districtInfo->name ?? '' }}</p>
                            </a>
                        </div>
                        <div class="list-group pt-2 col-4">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Upozilla</h5>
                                </div>
                                <p class="mb-1">{{ $news->region->upozillaInfo->name ?? '' }}</p>
                            </a>
                        </div>
                    </div>
                    <div class="item pt-3">
                        <p class="text-md-left font-weight-bold">Keywords</p>
                        @foreach ($keyWords as $keword)
                            <span class="badge badge-info pr-1">{{ $keword->name ?? '' }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
