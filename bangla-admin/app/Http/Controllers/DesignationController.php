<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::all();
        return view('admin.designation.index', compact('designations'));
    }

    public function delete($id)
    {
        $designation = Designation::find($id);
        $designation->delete();
        return back();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        Designation::create(
            [
                'name' => $request->name
            ]
        );

        return back();
    }
}
