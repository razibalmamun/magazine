<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Latest;
use App\Models\News;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LatestController extends Controller
{
    public function getAllSorbadhik($limit, $date = '')
    {
        if ($date) {
            $latest = Latest::select('news_id')->where('date', $date)->orderBy('count', 'DESC')->take($limit)->get();
            $latestIds = $this->mapArray($latest);
        } else {
            $date = Date('Y-m-d');
            $latest = Latest::select('news_id')->where('date', $date)->orderBy('count', 'DESC')->take($limit)->get();
            $latestIds = $this->mapArray($latest);
        }

        $news = News::where('published', 1)->whereIn('id', $latestIds)->get()->map->format();

        return response()->json($news);
    }

    public function mapArray($array): array
    {
        $mappedArray = [];
        foreach ($array as $item) {
            $mappedArray[] = $item->news_id;
        }
        return $mappedArray;
    }

    public function getAllLatest($limit, $skip = 0): \Illuminate\Http\JsonResponse
    {
        $latest = News::where('published', 1)
            ->where('latest', 1)
            ->orderBy('date', 'DESC')
            ->orderBy('order', 'asc')
            ->where('date', '<', date('Y-m-d H:i:s', strtotime(Date('Y-m-d') . ' +1 day')))
            ->skip($skip)
            ->take($limit)
            ->get()
            ->map->format();
        return response()->json($latest);
    }

    public function readersChoice($limit, $skip = 0)
    {
        $latest = Latest::select('news_id')
            ->distinct()
            ->whereBetween(
                DB::raw('DATE(date)'),
                [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
            )
            ->orderBy('count', 'DESC')->skip($skip)->take($limit)->get();
        $latestId = $this->mapArray($latest);
        $news = News::where('published', 1)->whereIn('id', $latestId)->get()->map->format();
        return response()->json($news);
    }
}
