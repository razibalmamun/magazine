<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HelperRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Keyword as KeywordModel;
use App\Models\TrendingDetails;

class Keyword extends Controller
{
    private $_helepr;

    public function __construct(HelperRepositoryInterface $helper)
    {
        $this->_helepr = $helper;
    }

    public function index()
    {
        return view('admin.news.keyword.index');
    }

    public function indexTrending()
    {
        $keywordlist = KeywordModel::where('trending', 1)->orderBy('id', 'desc')->get();
        return view('admin.trending.index', compact('keywordlist'));
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $keyword = new KeywordModel();
        $keyword->name = $request->name;
        $keyword->save();

        return redirect('/admin/news/keyword/list');
    }

    public function list()
    {
        $keywordlist = KeywordModel::orderBy('id', 'desc')->get();
        return view('admin.news.keyword.list', compact('keywordlist'));
    }

    public function view($id)
    {
        $keyword = KeywordModel::where('id', $id)->first();

        return view('admin.news.keyword.view', compact('keyword'));
    }

    public function edit($id)
    {
        $keyword = KeywordModel::where('id', $id)->first();
        return view('admin.news.keyword.edit', compact('keyword'));
    }

    public function update(Request $request)
    {
        $keyword = KeywordModel::where('id', $request->id)->first();
        $keyword->name = $request->name;
        $keyword->save();

        return redirect('/admin/news/keyword/list');
    }

    public function delete($id)
    {
        $keyword = KeywordModel::where('id', $id)->first();
        $keyword->delete();

        return back();
    }

    public function makeTrending($id)
    {
        $keyword = KeywordModel::find($id);
        $keyword->trending = 1;
        $keyword->save();

        return back();
    }

    public function removeTrending($id)
    {
        $keyword = KeywordModel::find($id);
        $keyword->trending = 0;
        $keyword->save();

        return back();
    }

    public function detailsTrending($id)
    {
        $trndingDetails = TrendingDetails::where('trending_id', $id)->first();
        return view('admin.trending.details', compact('trndingDetails', 'id'));
    }

    public function detailsStoreTrending(Request $request)
    {
        if ($request->id) {
            $trending = TrendingDetails::find($request->id);
        } else {
            $trending = new TrendingDetails();
        }

        $trending->trending_id = $request->trending_id;
        $trending->details = $request->details;
        if ($request->hasFile('image')) {
            $imagePath = $this->_helepr->imageUpload($request->file('image'));
            $trending->image = $imagePath;
        }
        $trending->save();
        return redirect('admin/news/keyword/index-trending');
    }

    public function getKeyword()
    {
        $term = request()->search;
        $keywordlist = KeywordModel::orderBy('id', 'desc')->where('name', 'like', '%' . $term . '%')->paginate(10);
        return response()->json($keywordlist);
    }
}
