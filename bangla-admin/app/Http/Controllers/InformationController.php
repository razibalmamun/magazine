<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class InformationController extends Controller
{
    public function index()
    {
        $informationList = Information::all();
        return view('admin.information.index', compact('informationList'));
    }

    public function edit()
    {
        $informationList = Information::all();
        return view('admin.information.edit', compact('informationList'));
    }

    public function update(Request $request)
    {
        $infArray = ['total_affected_bd', 'total_recover_bd', 'total_death_bd', 'total_affected_int', 'total_recover_int', 'total_death_int'];
        $request->validate([
            'total_affected_bd' => 'required',
            'total_recover_bd' => 'required',
            'total_death_bd' => 'required',
            'total_affected_int' => 'required',
            'total_recover_int' => 'required',
            'total_death_int' => 'required',
        ]);

        foreach ($infArray as $item) {
            $info = Information::where('info_key', $item)->first();
            $info->info_value = $request[$item];
            $info->save();
        }

        return redirect('/admin/information/index');
    }
}
