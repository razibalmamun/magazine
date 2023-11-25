<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\News;
use App\Models\Region;
use App\Models\Thana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getDivsions(): \Illuminate\Http\JsonResponse
    {
        $divisions = Division::get()->map->format();
        return response()->json($divisions);
    }

    public function getDistrictByDivision($divisionId): \Illuminate\Http\JsonResponse
    {
        $districs = District::where('division_id', $divisionId)->get()->map->format();
        return response()->json($districs);
    }

    public function getUpozillaByDivision($upoId): \Illuminate\Http\JsonResponse
    {
        $upozillas = Thana::where('district_id', $upoId)->get()->map->format();
        return response()->json($upozillas);
    }

    public function mapArray($array): array
    {
        $mappedArray = [];
        foreach ($array as $item) {
            $mappedArray[] = $item->news_id;
        }
        return $mappedArray;
    }


    public function filterNews($divisionId, $districtId = '', $upozillaId = '')
    {
        $newsIdObj = Region::select('news_id')->where('division', $divisionId);
        if ($districtId) {
            $newsIdObj->where('district', $districtId);
        }

        if ($upozillaId) {
            $newsIdObj->where('upozilla', $upozillaId);
        }

        $newsIds = $this->mapArray($newsIdObj->get());

        $news = News::where('published', 1)->whereIn('id', $newsIds)->orderBy('order', 'ASC')->get()->map->filterFormat();

        return response()->json($news);
    }

    public function getSearchResult($title)
    {
        $news = News::where('published', 1)->select('*')
            ->where('title', 'LIKE', '%' . $title . '%')
            ->orderBy(DB::raw("DATE_FORMAT(date,'%d-%M-%Y')"), 'DESC')
            ->paginate(10);
        return response()->json($news);
    }
}
