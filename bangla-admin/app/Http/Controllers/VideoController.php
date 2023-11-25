<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HelperRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * @var HelperRepositoryInterface
     */
    private $_helepr;

    public function __construct(HelperRepositoryInterface $helper)
    {
        $this->_helepr = $helper;
    }
    public function index(){
        return view('admin.news.video.index');
    }

    public function create(Request $request){
        $request->validate([
            'video_link' => 'required|max:255',
            'video_thumbnail' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'date_time' => 'required',
        ]);
        $time = strtotime($request->date);
        $newformat = date('Y-m-d', $time);
        $thumbnail_path = $this->_helepr->imageUpload($request->file('video_thumbnail'),$newformat);

        $video = new Video();
        $video->video_link = $request->video_link;
        $video->video_thumbnail = $thumbnail_path;
        $video->date_time = $request->date_time;
        $video->save();

        return redirect('/admin/news/video/list');
    }

    public function list(){
        $videoList = Video::orderBy('id','desc')->get();

        return view('admin.news.video.list', compact('videoList'));
    }

    public function view($id){
        $video = Video::where('id', $id)->first();

        return view('admin.news.video.view', compact('video'));
    }

    public function edit($id){
        $video = Video::where('id', $id)->first();

        return view('admin.news.video.edit', compact('video'));
    }
    public function update(Request $request){
        $request->validate([
            'video_link' => 'required|max:255',
            'order'     => 'required'
        ]);

        $video = Video::where('id', $request->id)->first();
        $video->video_link = $request->video_link;
        $video->order = $request->order;
        $video->save();

        return redirect('/admin/news/video/list');

    }

    public function delete($id){
        $video = Video::where('id', $id)->first();
        $this->_helepr->deleteImage($video->video_thumbnail);
        $video->delete();

        return redirect('/admin/news/video/list');
    }
}
