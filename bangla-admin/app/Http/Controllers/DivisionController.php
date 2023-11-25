<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\DivisionWe;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = DivisionWe::orderBy('id','desc')->get();
        return view('admin.division.index', compact('divisions'));
    }

    public function delete($id)
    {
        $division = DivisionWe::find($id);
        $division->delete();
        return back();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'order' => 'required',
        ]);

        DivisionWe::create(
            [
                'name' => $request->name,
                'order' => $request->order,
            ]
        );

        return back();
    }

    public function edit($id)
    {
        $division = DivisionWe::find($id);
        return view('admin.division.edit', compact('division'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'order' => 'required',
        ]);
        
        $division = DivisionWe::find($request->id);
        $division->name = $request->name;
        $division->order = $request->order;
        $division->save();
        return redirect('admin/division/index');
    }
}
