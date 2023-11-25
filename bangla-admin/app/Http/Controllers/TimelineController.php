<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        $timelines = Timeline::all();

        return view('admin.timeline.index', compact('timelines'));
    }

    public function delete($id)
    {
        $timeline = Timeline::find($id);
        $timeline->delete();
        $news = News::where('timeline_id', $id)->get();
        foreach ($news as $item) {
            $item->timeline_id = null;
            $item->save();
        }

        return back();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        Timeline::create(
            [
                'name' => $request->name
            ]
        );

        return back();
    }

    public function timelineNews($id)
    {
        $timeline = Timeline::find($id);
        $news = News::where('timeline_id', $id)->get();
        return view('admin.timeline.news', compact('news', 'timeline'));
    }

    public function removeNews($id)
    {
        $news = News::find($id);
        $news->timeline_id = null;
        $news->save();

        return back();
    }

    public function getTimeline($id='')
    {
        $keywordlist = Timeline::orderBy('id', 'desc')
            ->when($id, function ($q, $id) {
                return $q->where('id', '!=', $id);
            })
            ->take(50)->get();
        return response()->json($keywordlist);
    }
}
