<?php

namespace App\Http\Controllers;

use App\Models\CMS;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public function index()
    {
        $cms = CMS::all();
        return view('admin.cms.index',compact('cms'));
    }

    public function view($id)
    {
        $cms = CMS::find($id);
        return view('admin.cms.view',compact('cms'));
    }

    public function edit($id)
    {
        $cms = CMS::find($id);
        return view('admin.cms.edit',compact('cms'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $cms = CMS::find($request->id);
        $cms->content = $request->content;
        $cms->save();

        return redirect('admin/cms/index');
    }
}
