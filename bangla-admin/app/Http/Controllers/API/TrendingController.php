<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use App\Models\TrendingDetails;
use Illuminate\Http\Request;

class TrendingController extends Controller
{
    public function allTrending($limit, $skip = 0)
    {
        $trendingList = Keyword::where('trending', 1)->orderBy('id', 'desc')->skip($skip)->take($limit)->get();
        return response()->json($trendingList);
    }

    public function trendingDetails($id)
    {
        $trending = TrendingDetails::where('trending_id', $id)->first();
        return response()->json($trending);
    }
}
