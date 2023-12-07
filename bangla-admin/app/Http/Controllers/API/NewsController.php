<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Latest;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsSubCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function getCategory(): \Illuminate\Http\JsonResponse
    {
        $categories = Category::where('visible', 1)->with('subCategories')->orderBy('order', 'ASC')->get();
        return response()->json([$categories]);
    }

    public function getCategoryById($id)
    {
        $category = Category::where('id', $id)->with('subCategories')->first();
        return response()->json($category);
    }

    public function getAllNews($categoryId, $type, $limit, $skip = 0, $sub = 0): \Illuminate\Http\JsonResponse
    {
        $key = 'category_id';
        if ($sub) {
            if ($categoryId == 1) {
                $newsIds = News::where('published', 1)
                    ->join('news_sub_categories', 'news_sub_categories.news_id', 'news.id')
                    ->where('news_sub_categories.sub_category_id', $sub)
                    ->orderBy('news.order', 'asc')
                    ->where('news.date', '<', date('Y-m-d H:i:s', strtotime(Date('Y-m-d') . ' +1 day')))
                    ->where('type', $type)
                    ->select('news.id')
                    ->skip($skip)
                    ->take($limit)
                    ->get();
            } else {
                $newsIds = News::where('published', 1)
                    ->join('news_sub_categories', 'news_sub_categories.news_id', 'news.id')
                    ->where('news_sub_categories.sub_category_id', $sub)
                    // ->orderBy('news.date','DESC')
                    ->orderBy('news.id', 'desc')
                    ->where('news.date', '<', date('Y-m-d H:i:s', strtotime(Date('Y-m-d') . ' +1 day')))
                    ->select('news.id')
                    ->skip($skip)
                    ->take($limit)
                    ->get();
            }

            $news = [];
            foreach ($newsIds as $id) {
                $news[] = $this->newsById($id->id);
            }

            return response()->json($news);
        }

        if ($categoryId == 1) {
            $newsIds = News::where('published', 1)->join('news_categories', 'news_categories.news_id', 'news.id')
            ->where('news_categories.category_id', $categoryId)
            // ->orderByRaw("news.order ASC, news.updated_at desc")->groupBy('news.order')
            // ->orderBy('news.date','DESC')
            ->orderBy('news.order', 'asc')
            ->where('news.date', '<', date('Y-m-d H:i:s', strtotime(Date('Y-m-d') . ' +1 day')))
            ->where('type', $type)
            ->where('news.order', '>', 0)
            ->select('news.id')
            ->skip($skip)
            ->take($limit)
            ->get();
        }else{
            $newsIds = News::where('published', 1)->join('news_categories', 'news_categories.news_id', 'news.id')
            ->where('news_categories.category_id', $categoryId)
            ->orderBy('news.id', 'desc')
            ->where('news.date', '<', date('Y-m-d H:i:s', strtotime(Date('Y-m-d') . ' +1 day')))
            ->select('news.id')
            ->skip($skip)
            ->take($limit)
            ->get();
        }

        
        $news = [];
        foreach ($newsIds as $id) {
            $news[] = $this->newsById($id->id);
        }

        return response()->json($news);
    }

    public function getBoxNews($type, $limit): \Illuminate\Http\JsonResponse
    {
        $news = [];
        for ($boxNumber=1; $boxNumber <= $limit; $boxNumber++) { 
            $newsId = News::where('published', 1)
            ->select('news.id')
            ->where('type', $type)
            ->where('news.order', $boxNumber)        
            ->orderBy('news.id', 'desc')
            ->first();
            
            if($newsId) {
                $news[] = $this->newsById($newsId->id);
            }
        }
        return response()->json($news);
    }

    public function increaseCount($id)
    {
        $latest = Latest::where('news_id', $id)->where('date', Date('Y-m-d'))->first();
        if ($latest) {
            $latest->count += 1;
            $latest->save();
        } else {
            $latest = new Latest();
            $latest->news_id = $id;
            $latest->count = 1;
            $latest->date = Date('Y-m-d');
            $latest->save();
        }
    }

    public function newsById($id)
    {
        $news = News::find($id);
        $categories = NewsCategory::join('categories', 'categories.id', 'news_categories.category_id')->where('news_categories.news_id', $id)->select('categories.id', 'categories.name')->get();
        $subCategories = NewsSubCategory::join('subcategories', 'news_sub_categories.sub_category_id', 'subcategories.id')->where('news_sub_categories.news_id', $id)->select('subcategories.id', 'subcategories.name')->get();
        $this->increaseCount($id);
        $keyWords = [];
        foreach ($news->keywordList as $item) {
            $keyWords[] = [
                'id' => isset($item->keywordItem->id) ? $item->keywordItem->id : '',
                'name' => isset($item->keywordItem->name) ? $item->keywordItem->name : '',
            ];
        }

        return [
            'id' => $news->id,
            'title' => $news->title,
            'sort_description' => $news->sort_description,
            'order' => $news->order,
            'category' => $categories,
            'sub_category' => $subCategories,
            'date' => $news->date,
            'image' => $news->image,
            'type' => $news->type,
            'details' => $news->details->details,
            'ticker' => $news->details->ticker,
            'shoulder' => $news->details->shoulder,
            'representative' => $news->details->representative,
            'video_link' => $news->details->video_link,
            'google_drive_link' => $news->details->google_drive_link,
            'audio_link' => $news->details->audio_link,
            'keyword' => $keyWords,
            'timeline_id' => $news->timeline_id,
        ];
    }

    public function getNews($id): \Illuminate\Http\JsonResponse
    {

        $this->increaseCount($id);
        $news = $this->newsById($id);
        return response()->json($news);
    }

    public function getAllNewsByCategory($categoryId, $limit, $skip)
    {
        $newsIds = News::where('published', 1)->join('news_categories', 'news_categories.news_id', 'news.id')
            ->where('news_categories.category_id', $categoryId)
            ->select('news.id')
            ->orderBy('news.date', 'DESC')
            ->orderBy('news.order', 'asc')
            ->where('news.date', '<', date('Y-m-d H:i:s', strtotime(Date('Y-m-d') . ' +1 day')))
            ->skip($skip)
            ->take($limit)
            ->get();
        $news = [];
        foreach ($newsIds as $id) {
            $news[] = $this->newsById($id->id);
        }

        $category = Category::find($categoryId);
        return response()->json([
            'category' => $category,
            'news' => $news
        ]);
    }

    public function getAllNewsBySubCategory($subCategoryId, $limit, $skip)
    {
        $newsIds = News::where('published', 1)
            ->join('news_sub_categories', 'news_sub_categories.news_id', 'news.id')
            ->where('news_sub_categories.sub_category_id', $subCategoryId)
            ->orderBy('news.date', 'DESC')
            ->orderBy('news.order', 'asc')
            ->where('news.date', '<', date('Y-m-d H:i:s', strtotime(Date('Y-m-d') . ' +1 day')))
            ->select('news.id')
            ->skip($skip)
            ->take($limit)
            ->get();

        $news = [];
        foreach ($newsIds as $id) {
            $news[] = $this->newsById($id->id);
        }

        $subCategory = Subcategory::find($subCategoryId);
        return response()->json([
            'sub-category' => $subCategory,
            'news' => $news
        ]);
    }
}
