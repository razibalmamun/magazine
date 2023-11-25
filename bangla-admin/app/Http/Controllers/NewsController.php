<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HelperRepositoryInterface;
use App\Models\District;
use App\Models\News;
use App\Models\NewsDetails;
use App\Models\Region;
use App\Models\Thana;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Keyword;
use App\Models\LiveNews;
use App\Models\NewsCategory;
use App\Models\NewsKeyword;
use App\Models\NewsSubCategory;
use App\Models\Published;
use App\Models\Seo;
use App\Models\Timeline;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class NewsController extends Controller
{
    public const PRCCHOD_ID = 1;
    public const RAJNITI_ID = 2;
    public const JATIO_ID = 3;
    public const KHELA_ID = 4;
    public const ANTORJATIK_ID = 5;
    public const BINODON_ID = 6;
    public const HEALTH_ID = 7;
    public const FEATURE_ID = 8;

    /**
     * @var HelperRepositoryInterface
     */
    private $_helepr;

    public function __construct(HelperRepositoryInterface $helper)
    {
        $this->_helepr = $helper;
    }

    /**
     * @return void
     */
    public function index()
    {
         $news = News::orderby('date', 'DESC')->take(400)->get();
        return view('admin.news.index', compact('news'));
    }

    public function MostRead(){
        $news = DB::table('news as n')->
        join('latests as l', 'n.id', '=', 'l.news_id')->
        limit(1000)->
        orderBy('l.count', 'DESC')->
        get([
          'n.id',
          'n.title',
          'n.author_id',
          'l.count',
          'l.updated_at as last_visit'
        ]);
        return view('admin.news.most_read', compact('news'));
    }


    public function create()
    {
        $timelines = Timeline::orderBy('id', 'desc')->get();
        $categories = Category::get();
        $divisions = $this->_helepr->getDivsions();
        return view('admin.news.create', compact('categories', 'divisions', 'timelines'));
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'title' => 'required|max:255',
            'sort_description' => 'required',
            'category_id' => 'required',
            'type' => 'required',
            'details' => 'required',
            'representative' => 'required',
            'keyword' => 'required',
            'order' => 'required',
            'category' => 'required'
        ]);

        $time = strtotime($request->date);
        $newformat = date('Y-m-d', $time);
        $imagePath = $this->_helepr->imageUpload($request->file('image'), $newformat);
        $news = new News();
        $news->title = $request->title;
        $news->sort_description = $request->sort_description;
        $news->category_id = 0;
        $news->sub_category_id = 0;
        $news->order = $request->order;
        $news->type = $request->type;
        $news->image = $imagePath;
        $news->date = $request->date ? $request->date : date('Y-m-d h:i:s');
        $news->latest = $request->latest ?? 0;
        $news->news_marquee = $request->news_marquee ?? 0;
        $news->live_news = $request->live_news ?? 0;
        $news->timeline_id = $request->timeline_id;
        $news->save();
        foreach ($request->category as $cat) {
            $newsCategory = new NewsCategory();
            $newsCategory->news_id = $news->id;
            $newsCategory->category_id = $cat;
            $newsCategory->save();
        }
        if ($request->sub_category) {
            foreach ($request->sub_category as $subCat) {
                $newsSubCat = new NewsSubCategory();
                $newsSubCat->news_id = $news->id;
                $newsSubCat->sub_category_id = $subCat;
                $newsSubCat->save();
            }
        }
        $newsDetails = new NewsDetails();
        $newsDetails->news_id = $news->id;
        $newsDetails->details = $request->details;
        $newsDetails->ticker = $request->ticker;
        $newsDetails->video_link = $request->video_link;
        $newsDetails->google_drive_link = $request->google_drive_link;
        $newsDetails->audio_link = $request->audio_link;
        $newsDetails->representative = $request->representative;
        $newsDetails->shoulder = $request->shoulder;
        $newsDetails->keyword = json_encode($request->keyword);
        $newsDetails->save();
        foreach ($request->keyword as $keyword) {
            $item = new NewsKeyword();
            $item->news_id = $news->id;
            $item->keyword_id = $keyword;
            $item->save();
        }
        $region = new Region();
        $region->news_id = $news->id;
        $region->division = $request->division;
        $region->district = $request->district;
        $region->upozilla = $request->upozilla;
        $region->save();
        $publisher = new Published();
        $publisher->news_id = $news->id;
        $publisher->created_by = auth()->user()->id;
        $publisher->save();

        $seo = new Seo();
        $seo->title = $request->title2 ? $request->title2 : $request->title;
        $seo->news_id = $news->id;
        $seo->share_title = $request->share_title ? $request->share_title : $request->sort_description;
        $seo->description = $request->description ? $request->description : $request->sort_description;
        $seo->keywords = $request->keywords;
        if ($request->hasFile('page_img')) {
            $imagePath = $this->_helepr->imageUpload($request->file('page_img'), $newformat, true);
            $seo->page_img = $imagePath;
        } else {
            $seo->page_img = $this->_helepr->imageUpload($request->file('image'), $newformat, true);
        }

        $seo->save();

        return redirect('admin/news/index-by-category/' . $cat);
    }

    public function update(Request $request)
    {
        
      
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'title' => 'required|max:255',
            'sort_description' => 'required',
            'category_id' => 'required',
            'type' => 'required',
            'details' => 'required',
            'date' => 'required',
            'representative' => 'required',
            'keyword' => 'required',
            'order' => 'required',
            'category' => 'required',
        ]);

        $time = strtotime($request->date);
        $newformat = date('Y-m-d', $time);
        $news = News::find($request->id);
        $news->title = $request->title;
        $news->sort_description = $request->sort_description;
        $news->order = $request->order;
        $news->type = $request->type;
        $news->latest = $request->latest ?? 0;
        $news->news_marquee = $request->news_marquee ?? 0;
        $news->live_news = $request->live_news ?? 0;
        $news->timeline_id = $request->timeline_id;
        if ($request->hasFile('image')) {
            $imagePath = $this->_helepr->imageUpload($request->file('image'), $newformat);
            $news->image = $imagePath;
        }
        $news->date = $request->date;
        $news->save();
        DB::statement('delete from news_categories where news_id = ' . $request->id . '');
        DB::statement('delete from news_sub_categories where news_id = ' . $request->id . '');
        foreach ($request->category as $cat) {
            $newsCategory = new NewsCategory();
            $newsCategory->news_id = $news->id;
            $newsCategory->category_id = $cat;
            $newsCategory->save();
        }
        if ($request->sub_category) {
            foreach ($request->sub_category as $subCat) {
                $newsSubCat = new NewsSubCategory();
                $newsSubCat->news_id = $news->id;
                $newsSubCat->sub_category_id = $subCat;
                $newsSubCat->save();
            }
        }
        $newsDetails = NewsDetails::where('news_id', $request->id)->first();
        $newsDetails->details = $request->details;
        $newsDetails->ticker = $request->ticker;
        $newsDetails->video_link = $request->video_link;
        $newsDetails->google_drive_link = $request->google_drive_link;
        $newsDetails->audio_link = $request->audio_link;
        $newsDetails->representative = $request->representative;
        $newsDetails->shoulder = $request->shoulder;
        $newsDetails->keyword = json_encode($request->keyword);
        $newsDetails->save();
        $region = Region::where('news_id', $request->id)->first();
        if (!$region) {
            $region = new Region();
        }
        $region->news_id = $news->id;
        $region->division = $request->division;
        $region->district = $request->district;
        $region->upozilla = $request->upozilla;
        $region->save();
        DB::table("news_keywords")->where('news_id', $news->id)->delete();
        foreach ($request->keyword as $keyword) {
            $item = new NewsKeyword();
            $item->news_id = $news->id;
            $item->keyword_id = $keyword;
            $item->save();
        }

        $seo = Seo::where('news_id', $request->id)->first();
        if (!$seo) {
            $seo = new Seo();
        }
        $seo->title = $request->title2;
        $seo->news_id = $news->id;
        $seo->share_title = $request->share_title;
        $seo->description = $request->description;
        $seo->keywords = $request->keywords;
        if ($request->hasFile('page_img')) {
            $imagePath = $this->_helepr->imageUpload($request->file('page_img'), $newformat);
            $seo->page_img = $imagePath;
        }
        $seo->save();

        return redirect('admin/news/index-by-category/' . $cat);
    }

    public function publish($newsId)
    {
        $news = News::find($newsId);
        $news->published = 1;
        $news->save();
        $publisher =  Published::where('news_id', $newsId)->first();
        $publisher->published_by = auth()->user()->id;
        $publisher->save();
        return back();
    }

    public function proofreader($newsId)
    {
        $news = News::find($newsId);
        $news->proofreader = 1;
        $news->save();
        return back();
    }

    public function listProofreader()
    {
        $news = News::where('proofreader', 1)->orderby('date', 'DESC')->get();
        return view('admin.proofreader.proofreader', compact('news'));
    }

    public function submitProofreader($newsId)
    {
        $news = News::find($newsId);
        $news->proofreader = 2;
        $news->save();
        return back();
    }

    public function createByCategory($categoryId, $categoryName)
    {
        $categories = Category::get();
        $timelines = Timeline::orderBy('id', 'desc')->get();
        $divisions = $this->_helepr->getDivsions();
        return view('admin.news.add-by-category.create', compact('categories', 'categoryId', 'divisions', 'categoryName', 'timelines'));
    }

    public function getList($categoryId)
    {
        $role = auth()->user()->role;
        if ($role == 'representative') {
            $news = News::select('news.*')->orderby('date', 'DESC')->join('news_categories', 'news.id', 'news_categories.news_id')->join('publisheds', 'publisheds.news_id', 'news.id')->join('users', 'users.id', 'publisheds.created_by')->where('news_categories.category_id', $categoryId)->where('users.id', auth()->user()->id)->take(1000)->get();
        } else {
            $news = News::select('news.*')->join('news_categories', 'news.id', 'news_categories.news_id')->where('news_categories.category_id', $categoryId)->orderby('date', 'DESC')->take(1000)->get();
        }

        $categoryName = Category::where('id', $categoryId)->pluck('name')->first();

        return view('admin.news.add-by-category.index', compact('news', 'categoryName', 'categoryId'));
    }

    public function edit($newsId, $categoryName = '')
    {
        $newskeyWordJson = NewsDetails::select('keyword')->where('news_id', $newsId)->first();
        $newsKeywords = json_decode($newskeyWordJson->keyword);
        $keyWords = Keyword::whereIn('id', $newsKeywords)->get();
        $news = News::find($newsId);
        $divisions = $this->_helepr->getDivsions();
        $categoryId = $news->category_id;
        $role = auth()->user()->role;
        $seo = Seo::where('news_id', $newsId)->first();
        $categories = Category::get();
        $newsCategory = NewsCategory::where('news_id', $newsId)->pluck('category_id')->toArray();
        $newsSubCategory = NewsSubCategory::where('news_id', $newsId)->pluck('sub_category_id')->toArray();
        $timelines = Timeline::where('id', $news->timeline_id)->first();
        if ($role == 'representative' && $news->published == 1) {
            abort(403);
        }
        return view('admin.news.add-by-category.edit', compact('news', 'keyWords', 'divisions', 'newsKeywords', 'categoryName', 'timelines', 'categoryId', 'seo', 'categories', 'newsCategory', 'newsCategory', 'newsSubCategory'));
    }

    public function delete($newsId)
    {
        $news = News::find($newsId);
        $role = auth()->user()->role;
        if ($role == 'representative' && $news->published == 1) {
            abort(403);
        }
        $this->_helepr->deleteImage($news->image);
        $news->delete();
        DB::table("news_keywords")->where('news_id', $newsId)->delete();
        return back();
    }

    public function view($newsId)
    {
        $news = News::find($newsId);
        if (isset($news->details->keyword)) {
            $keyWords = Keyword::whereIn('id', json_decode($news->details->keyword))->get();
        }
        $keyWords = ['null' => 0];
        $categories = NewsCategory::where('news_id', $newsId)->get();
        $subCategories = NewsSubCategory::where('news_id', $newsId)->get();
        // return response()->json($subCategories);

        return view('admin.news.add-by-category.view', compact('news', 'keyWords', 'categories', 'subCategories'));
    }

    public function getDistrictByDivId($divisionID)
    {
        $districts = District::where('division_id', $divisionID)->get();
        return response()->json($districts);
    }

    public function getUpozillaByDisId($districtID)
    {
        $upozilla = Thana::where('district_id', $districtID)->get();
        return response()->json($upozilla);
    }

    public function getKeyWord($newsId)
    {
        $newskeyWordJson = NewsDetails::select('keyword')->where('news_id', $newsId)->first();
        $keywords = Keyword::get();
        $newsKeywords = json_decode($newskeyWordJson->keyword);

        $html = '';
        foreach ($keywords as $keyWord) {
            $selected = in_array($keyWord->name, $newsKeywords) ? 'selected' : '';
            $html .= '<option value"' . $keyWord->id . ' ' . $selected . '>' . $keyWord->name . '</option>';
        }

        return response()->json($html);
    }

    public function publishNews($id)
    {
        $news = News::find($id);
        $news->published = 1;
        $news->save();
        $published = Published::where('news_id', $id)->first();
        $published->published_by = auth()->user()->id;
        $published->save();

        return back();
    }

    public function getListLiveNews()
    {
        $news = News::where('live_news', 1)->get();
        return view('admin.news.live-news.index', compact('news'));
    }

    public function liveNews($newsId)
    {
        $liveNews = LiveNews::where('news_id', $newsId)->orderBy(DB::raw("DATE_FORMAT(date,'%d-%M-%Y')"), 'DESC')->get();
        return view('admin.live-news.index', compact('newsId', 'liveNews'));
    }

    public function liveNewsStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'details' => 'required',
            'date' => 'required',
        ]);

        $liveNews = new LiveNews();
        $liveNews->title = $request->title;
        $liveNews->details = $request->details;
        $liveNews->date = $request->date;
        $liveNews->news_id = $request->news_id;
        $liveNews->save();

        return back();
    }

    public function liveNewsDelete($newsId)
    {
        News::where('id', $newsId)->update(['live_news' => 0]);
        // $liveNews = LiveNews::where('id', $newsId);
        // $liveNews->delete();

        return back();
    }

    public function liveNewsEdit($newsId)
    {
        $liveNews = LiveNews::find($newsId);
        return view('admin.live-news.edit', compact('liveNews'));
    }

    public function liveNewsUpdate(Request $request)
    {
        $liveNews =  LiveNews::where('news_id', $request->news_id)->first();
        $liveNews->title = $request->title;
        $liveNews->details = $request->details;
        $liveNews->date = $request->date;
        $liveNews->news_id = $request->news_id;
        $liveNews->save();

        return redirect('admin/news/live-index/' . $request->news_id);
    }

    public function orderNews()
    {
        $categories = Category::all();
        return view('admin.news.order-news.order', compact('categories'));
    }

    public function orderNewsStore(Request $request)
    {
        $date = $request->date;
        $categories = Category::all();
        $list = News::where('type', $request->type)
            ->when($request->date, function ($query, $date) {
                $query->whereBetween(DB::raw('DATE(date)'), [$date, $date]);
            })
            ->orderBy('news.id', 'desc')
            ->select('news.id', 'news.date', 'news.type', 'news.title', 'news.order')
            ->join('news_categories', 'news_categories.news_id', 'news.id')
            ->where('news_categories.category_id', $request->category_id)->take(150)->get();
        return response()->json($list);
    }

    public function orderUpdate(Request $request)
    {
        $news = News::find($request->id);
        $news->order = $request->order;
        $news->save();
        return response()->json([
            'message' => 'Order updated successfully'
        ]);
    }
}
