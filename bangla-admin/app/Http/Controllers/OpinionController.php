<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\HelperRepositoryInterface;
use App\Models\Opinion;

class OpinionController extends Controller
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
        return view('admin.opinion.index');
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'short_description' => 'required',
            'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'date' => 'required',
            'order'     => 'required'
        ]);

        $image = $this->_helepr->imageUpload($request->file('image_file'));

        $opinion = new Opinion();
        $opinion->title = $request->title;
        $opinion->description = $request->description;
        $opinion->short_description = $request->short_description;
        $opinion->image_file = $image;
        $opinion->date = $request->date;
        $opinion->order = $request->order;
        $opinion->save();

        return redirect('/admin/opinion/list');
    }

    public function list(){
        $opinionList = Opinion::get();

        return view('admin.opinion.list', compact('opinionList'));
    }

    public function view($id){
        $opinion = Opinion::where('id', $id)->first();

        return view('admin.opinion.view', compact('opinion'));
    }

    public function edit($id){
        $opinion = Opinion::where('id', $id)->first();

        return view('admin.opinion.edit', compact('opinion'));
    }
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'short_description' => 'required',
            // 'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'date' => 'required',
            'order'     => 'required'
        ]);

        $opinion = Opinion::where('id', $request->id)->first();
        $opinion->title = $request->title;
        $opinion->description = $request->description;
        $opinion->short_description = $request->short_description;
        // $opinion->image_file = $image;
        $opinion->date = $request->date;
        $opinion->order = $request->order;
        $opinion->save();

        return redirect('/admin/opinion/list');

    }

    public function delete($id){
        $opinion = Opinion::where('id', $id)->first();
        $opinion->delete();

        return redirect('/admin/opinion/list');
    }
}
