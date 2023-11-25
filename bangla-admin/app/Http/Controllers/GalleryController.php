<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HelperRepositoryInterface;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    private $_helepr;
    
    public function __construct(HelperRepositoryInterface $helper)
    {
        $this->_helepr = $helper;
    }

    public function index()
    {
        $galleries = Gallery::orderBy('id','desc')->paginate(25);
        return view('admin.gallery.index',compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $gallery = new Gallery();
        $newformat = date('Y-m-d');

        $image = $this->_helepr->imageUpload($request->file('image_file'), $newformat);
        $gallery->image_file = $image;
        $gallery->save();

        return redirect('/admin/gallery/index');

    }
}
