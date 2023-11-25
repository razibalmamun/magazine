@extends('admin.layout.master')
@section('styles')
    <style>
        .notificationCard {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 8px;
            padding: 8px;
            margin: 10px;
            /* color: red; */
        }

        .notificationHeader {
            display: flex;
            justify-content: space-between;
        }

        .notificationText {
            font-size: 16px;
            font-weight: bold;
            color: darkblue;
        }

        .notificationIcon {
            font-size: 25px;
            color: cadetblue;
        }

        .notificationValue {
            font-size: 25px;
            font-weight: bold;
            color: green;
        }

    </style>
@endsection()
@section('body')
    {{-- <div class="card"> --}}
        <div class="row">
            <div class="col-3">
                <div class="notificationCard">
                    <div class="notificationHeader">
                        <span class="notificationText">Total Users</span>
                        <span class="notificationIcon"><i class="fa fa-id-card" aria-hidden="true"></i></span>
                    </div>
                    <div class="notificationValue">
                        {{$totalUser}}
                        <i class="fa fa-line-chart"></i>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="notificationCard">
                    <div class="notificationHeader">
                        <span class="notificationText">News</span>
                        <span class="notificationIcon"><i class="far fa-newspaper"></i></span>
                    </div>
                    <div class="notificationValue">
                        {{$totalNews}}
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="notificationCard">
                    <div class="notificationHeader">
                        <span class="notificationText">Published News</span>
                        <span class="notificationIcon"><i class="far fa-newspaper"></i></span>
                    </div>
                    <div class="notificationValue">
                        {{$publishedNews}}
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="notificationCard">
                    <div class="notificationHeader">
                        <span class="notificationText">Category</span>
                        <span class="notificationIcon"><i class="far fa-newspaper"></i></span>
                    </div>
                    <div class="notificationValue">
                        {{$category}}
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="notificationCard">
                    <div class="notificationHeader">
                        <span class="notificationText">Image</span>
                        <span class="notificationIcon"><i class="far fa-newspaper"></i></span>
                    </div>
                    <div class="notificationValue">
                        {{$image}}
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="notificationCard">
                    <div class="notificationHeader">
                        <span class="notificationText">Video</span>
                        <span class="notificationIcon"><i class="far fa-newspaper"></i></span>
                    </div>
                    <div class="notificationValue">
                        {{$video}}
                    </div>
                </div>
            </div>
            {{-- <div class="col-3">
                <div class="notificationCard">
                    <div class="notificationHeader">
                        <span class="notificationText">Total Views</span>
                        <span class="notificationIcon"><i class="far fa-newspaper"></i></span>
                    </div>
                    <div class="notificationValue">
                        {{$totalView->totalView}}
                    </div>
                </div>
            </div> --}}
        </div>
    {{-- </div> --}}
@endsection
@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
@endsection()
