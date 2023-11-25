<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Image;
use App\Models\Latest;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalNews = News::count();
        $publishedNews = News::where('published',1)->count();
        $category = Category::count();
        $image = Image::count();
        $video = Video::count();
        return view('admin.home',compact('totalNews','publishedNews','category','image','video','totalUser'));
    }

    public function accessDenied()
    {
        return view('admin.access-denied');
    }
}
