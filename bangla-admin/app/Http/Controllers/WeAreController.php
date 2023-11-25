<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HelperRepositoryInterface;
use App\Models\Designation;
use App\Models\DivisionWe;
use App\Models\WeAre;
use Illuminate\Http\Request;

class WeAreController extends Controller
{
    public function __construct(HelperRepositoryInterface $helper)
    {
        $this->_helepr = $helper;
    }


    public function index()
    {
        $weare = WeAre::all();
        return view('admin.weare.index', compact('weare'));
    }

    public function create()
    {
        $designations = Designation::all();
        $divisions = DivisionWe::all();
        return view('admin.weare.create', compact('designations','divisions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'name' => 'required|max:255',
            'details' => 'required',
            'designation' => 'required',
            'div_id' => 'required',
        ]);
        $member = new WeAre();
        $member->name = $request->name;
        $imagePath = $this->_helepr->imageUpload($request->file('image'), date('Y-m-d'));
        $member->image = $imagePath;
        $member->details = $request->details;
        $member->div_id = $request->div_id;
        $member->designation = $request->designation;
        $member->save();

        return redirect('admin/weare/index');
    }

    public function delete($id)
    {
        $member = WeAre::find($id);
        $member->delete();
        return back();
    }

    public function edit($id)
    {
        $designations = Designation::all();
        $member = WeAre::find($id);
        return view('admin.weare.edit', compact('member', 'designations'));
        
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'name' => 'required|max:255',
            'details' => 'required',
            'designation' => 'required',
        ]);

        $member = WeAre::find($request->id);
        $member->name = $request->name;
        if ($request->hasFile('image')) {
            $imagePath = $this->_helepr->imageUpload($request->file('image'));
            $member->image = $imagePath;
        }
        $member->details = $request->details;
        $member->designation = $request->designation;
        $member->save();
        
        return redirect('admin/weare/index');
    }
}
