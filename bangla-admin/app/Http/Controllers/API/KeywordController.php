<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsKeyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function getNewsByKeyword($keywordId, $limit, $skip = 0)
    {
        $news = News::where('news.published', 1)->join('news_keywords', 'news.id', 'news_keywords.news_id')->select('news.id as id', 'news.image', 'news.date', 'news.title', 'news.sort_description')->where('news_keywords.keyword_id', $keywordId)->skip($skip)->take($limit)->orderBy('news.id', 'DESC')->get();
        return response()->json($news);
    }

    public function relatedNews($newsId, $limit, $skip)
    {
        $newsKeyWord = News::find($newsId);
        $news = News::where('news.published', 1)->join('news_keywords', 'news.id', 'news_keywords.news_id')->select('news.id as id', 'news.image', 'news.date', 'news.title', 'news.sort_description')->whereIn('news_keywords.keyword_id', json_decode($newsKeyWord->details->keyword))->skip($skip)->take($limit)->orderBy('news.id', 'DESC')->distinct('news.id')->get();
        return response()->json($news);
    }
}
