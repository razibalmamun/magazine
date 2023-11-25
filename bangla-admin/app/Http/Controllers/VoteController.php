<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HelperRepositoryInterface;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    private $_helepr;

    public function __construct(HelperRepositoryInterface $helper)
    {
        $this->_helepr = $helper;
    }

    public function index()
    {
        $votes = Vote::orderBy(DB::raw("DATE_FORMAT(date,'%d-%M-%Y')"), 'DESC')->get();
        return view('admin.vote.index', compact('votes'));
    }

    public function create()
    {
        return view('admin.vote.create');
    }

    public function store(Request $request)
    {
        echo 'hello';
        $request->validate([
            'description' => 'required',
            'order' => 'required',
            'date' => 'required',
            'image' => 'sometimes|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
        ]);

        if ($request->id) {
            $vote = Vote::find($request->id);
        } else {
            $vote = new Vote();
        }

        $time = strtotime($request->date);
        $newformat = date('Y-m-d', $time);
        $vote->description = $request->description;
        $vote->order = $request->order;
        $vote->date = $request->date;
        $vote->yes = 0;
        $vote->no = 0;
        $vote->no_comments = 0;
        if ($request->hasFile('image')) {
            $imagePath = $this->_helepr->imageUpload($request->file('image'), $newformat);
            $vote->image = $imagePath;
        }

        $vote->save();

        return redirect('admin/vote/index');
    }

    public function delete($id)
    {
        $vote = Vote::find($id);
        $vote->delete();
        return back();
    }

    public function edit($id)
    {
        $vote = Vote::find($id);
        return view('admin.vote.edit', compact('vote'));
    }

    public function activate($id)
    {
        $vote = Vote::find($id);
        $vote->status = 1;
        $vote->save();
        return back();
    }

    public function deactivate($id)
    {
        $vote = Vote::find($id);
        $vote->status = 0;
        $vote->save();
        return back();
    }
}
