<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SEOController extends Controller
{
    public function getPageSeo($type)
    {
        $seo = Seo::where('page_name',$type)->first();
        return response()->json($seo);
    }

    public function getNewsSeo($newsId)
    {
        $seo = Seo::where('news_id',$newsId)->first();
        return response()->json($seo);
    }
}
