<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function getTimelineNews($timelineId,$limit)
    {
        $news = News::where('published',1)->where('timeline_id',$timelineId)->take($limit)->get()->map->format();
        return response()->json($news);
        
    }
}
