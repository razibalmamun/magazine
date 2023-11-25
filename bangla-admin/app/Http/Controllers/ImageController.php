<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HelperRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * @var HelperRepositoryInterface
     */
    private $_helepr;

    public function __construct(HelperRepositoryInterface $helper)
    {
        $this->_helepr = $helper;
    }
    public function index()
    {
        return view('admin.news.image.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'date' => 'required',
        ]);

        $time = strtotime($request->date);
        $newformat = date('Y-m-d', $time);

        $image = $this->_helepr->imageUpload($request->file('image_file'), $newformat);

        $imageModel = new Image();
        $imageModel->title = $request->title;
        $imageModel->image_file = $image;
        $imageModel->date = $request->date;
        $imageModel->save();

        return redirect('/admin/news/image/list');
    }

    public function list()
    {
        $imageList = Image::orderBy('id','desc')->get();

        return view('admin.news.image.list', compact('imageList'));
    }

    public function view($id)
    {
        $image = Image::where('id', $id)->first();

        return view('admin.news.image.view', compact('image'));
    }

    public function edit($id)
    {
        $image = Image::where('id', $id)->first();

        return view('admin.news.image.edit', compact('image'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $image = Image::where('id', $request->id)->first();
        $image->title = $request->title;
        $image->save();

        return redirect('/admin/news/image/list');
    }

    public function delete($id)
    {
        $video = Image::where('id', $id)->first();
        $this->_helepr->deleteImage($video->image_file);
        $video->delete();

        return redirect('/admin/news/image/list');
    }
}
