<style>
    .main-image {
        display: block;
        padding: 5px;
        background: floralwhite;
    }

    .main-image__image {
        max-height: 50px;
        width: auto;
    }
</style>
<?php
$category = DB::table('categories')
    ->select('name', 'id')
    ->get();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ URL('admin/') }}" class="main-image">
        <img src="{{ asset('assets/dist/img/bnbd.png') }}" alt="AdminLTE Logo" class="main-image__image">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('admin/') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/profile') }}" class="nav-link">
                        <i class="nav-icon far fa-address-card"></i>
                        <p>
                            Edit Profile
                        </p>
                    </a>
                </li>

                @if (in_array(auth()->user()->role, ['admin', 'publisher', 'editor', 'desk_reporter']))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ URL('admin/user/create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL('admin/user/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All User List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (in_array(auth()->user()->role, ['admin', 'proofreader']))
                    <li class="nav-header">Proofreading</li>
                    <li class="nav-item">
                        <a href="{{ url('admin/news/list/proofreader') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                Proofreading List
                            </p>
                        </a>
                    </li>
                @endif
                @if (in_array(auth()->user()->role, ['admin', 'publisher', 'editor', 'desk_reporter', 'representative']))
                    <li class="nav-header">News</li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link">
                            <i class="far fa-newspaper"></i>
                            <p>
                                News
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ URL('admin/news/create-by-category/1/All') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create News</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL('admin/news/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All News</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL('admin/news/order-news') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ordering News</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL('admin/news-position') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>News Position</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL('admin/news/most-readed') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Most Readed News</p>
                                </a>
                            </li>
                            @foreach ($category as $item)
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-file-alt"></i>
                                        <p>
                                            {{ $item->name }}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ URL('admin/news/index-by-category/' . $item->id . '/') }}"
                                                class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>All </p>
                                            </a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a href="{{ URL('admin/news/create-by-category/' . $item->id . '/' . $item->name) }}"
                                                class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create New</p>
                                            </a>
                                        </li> --}}
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link">
                            <i class="far fa-newspaper"></i>
                            <p>
                                Live news
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ URL('admin/news/live-news/list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">Keyword</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Keyword
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/news/keyword/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Keyword</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('/admin/news/keyword/list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View All Keyword</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">Video and Image</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-video"></i>
                            <p>
                                Video
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/news/video/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Video</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('/admin/news/video/list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View All Videos</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-image"></i>
                            <p>
                                Image
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/news/image/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Image</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('/admin/news/image/list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View All Images</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">Votes</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-vote-yea"></i>
                            <p>
                                Votes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ URL('admin/vote/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Votes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL('admin/vote/create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create New</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-comment-alt"></i>
                            <p>
                                মতামত
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('admin/news/create-by-category/20/মতামত') }}"
                                    class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New মতামত</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('admin/news/index-by-category/20/মতামত') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All মতামত</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            News
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL('admin/news/index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All News</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL('admin/news/create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                @if (in_array(auth()->user()->role, ['admin', 'developer']))
                    <li class="nav-header">Category</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">

                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>
                                Category
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/news/category/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('/admin/news/category/list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View All Catgories</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-project-diagram"></i>
                            <p>
                                SubCategory
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/news/subcategory/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New SubCategory</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('/admin/news/subcategory/list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View All SubCatgories</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">News Timeline</li>
                    <li class="nav-item">
                        <a href="{{ url('admin/timeline/index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                Timeline
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/admin/news/keyword/index-trending') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                Trending
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">MISCELLANEOUS</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Information
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/information/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View All Information</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-stream"></i>
                            <p>
                                We Are
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/division/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Divisions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('/admin/weare/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>আমরা</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('/admin/designation/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Designation</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-stream"></i>
                            <p>
                                CMS Page
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/cms/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All CMS page</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-stream"></i>
                            <p>
                                Advertise
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/advertise/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All advertise</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('/admin/advertise/create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create new</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/seo/index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                Seo
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-at"></i>
                            <p>
                                Contact
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/contact/create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Contact</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('/admin/contact/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View All Contact</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-at"></i>
                            <p>
                                Gallery
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Url('/admin/gallery/create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Image</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Url('/admin/gallery/index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View All Images</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input type="submit" value="Log out" class="btn btn-danger btn-block" />
                        </form>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
