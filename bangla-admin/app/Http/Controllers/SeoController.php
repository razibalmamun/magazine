<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HelperRepositoryInterface;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    private $_helepr;

    public function __construct(HelperRepositoryInterface $helper)
    {
        $this->_helepr = $helper;
    }
    
    public function index()
    {
        $seos = Seo::where('news_id',null)->get();
        return view('admin.seo.index',compact('seos'));
    }

    public function create()
    {
        return view('admin.seo.create');
    }

    public function saveData(Request $request)
    {
        if($request->id){
            $seo = Seo::find($request->id);
        }else{
            $seo = new Seo();
        }

        $seo->title =$request->title;
        $seo->page_name =$request->page_name;
        $seo->news_id =$request->news_id;
        $seo->share_title =$request->share_title;
        $seo->description =$request->description;
        $seo->keywords =$request->keywords;
        if ($request->hasFile('page_img')) {
            $imagePath = $this->_helepr->imageUpload($request->file('page_img'));
            $seo->page_img = $imagePath;
        }

        $seo->save();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'page_img' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $this->saveData($request);

        return redirect('admin/seo/index');
    }

    public function edit($id)
    {
        $seo = Seo::find($id);
        return view('admin.seo.edit',compact('seo'));
    }

    public function delete($id)
    {
        $seo = Seo::find($id);
        $seo->delete();
        return back();
    }
}
