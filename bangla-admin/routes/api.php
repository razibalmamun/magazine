<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * default
 */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * category
 */
Route::get('/category', [App\Http\Controllers\API\NewsController::class, 'getCategory']);
Route::get('/category-by-id/{id}', [App\Http\Controllers\API\NewsController::class, 'getCategoryById']);
/**
 * vote
 */
Route::get('/vote-result', [App\Http\Controllers\API\VoteController::class, 'getVote']);
Route::get('/give-vote/{id}/{vote}', [App\Http\Controllers\API\VoteController::class, 'giveVote']);
Route::get('/change-vote/{id}/{prev}/{new}', [App\Http\Controllers\API\VoteController::class, 'changeVote']);

/**
 * news
 */
Route::get('/get-all-news/{categoryId}/{type}/{limit}/{skip}/{sub?}', [App\Http\Controllers\API\NewsController::class, 'getAllNews']);
Route::get('/get-news/{id}', [App\Http\Controllers\API\NewsController::class, 'getNews']);
Route::get('/get-news-by-category/{categoryId}/{limit}/{skip}', [App\Http\Controllers\API\NewsController::class, 'getAllNewsByCategory']);
Route::get('/get-news-by-sub-category/{subCategoryId}/{limit}/{skip}', [App\Http\Controllers\API\NewsController::class, 'getAllNewsBySubCategory']);

/**
 * opinion
 */
Route::get('/get-all-opinion/{limit}/{skip?}', [App\Http\Controllers\API\OpinionController::class, 'getAllOpinion']);
Route::get('/get-opinion/{id}', [App\Http\Controllers\API\OpinionController::class, 'getOpinion']);

/**
 * video
 */
Route::get('/get-all-video/{limit}/{skip}', [App\Http\Controllers\API\VideoController::class, 'getAllVideo']);
Route::get('/get-video/{id}', [App\Http\Controllers\API\VideoController::class, 'getVideo']);

/**
 * image
 */
Route::get('/get-all-image/{limit}/{skip?}', [App\Http\Controllers\API\ImageController::class, 'getAllImage']);
Route::get('/get-image/{id}', [App\Http\Controllers\API\ImageController::class, 'getImage']);

/**
 * Info
 */
Route::get('/get-all-info', [App\Http\Controllers\API\InformationController::class, 'getAllInfo']);

/**
 * Sorbadhik
 */
Route::get('/get-all-sorbadhik/{limit}/{date?}', [App\Http\Controllers\API\LatestController::class, 'getAllSorbadhik']);

/**
 * latest
 */
Route::get('/get-all-latest/{limit}/{skip}', [App\Http\Controllers\API\LatestController::class, 'getAllLatest']);

/**
 * contact
 */
Route::get('/get-all-contact/{limit}', [App\Http\Controllers\API\ContactController::class, 'getAllContact']);
Route::get('/get-contact/{id}', [App\Http\Controllers\API\ContactController::class, 'getContact']);

/**
 * Search
 */
Route::get('/get-all-divisions', [App\Http\Controllers\API\SearchController::class, 'getDivsions']);
Route::get('/get-all-district-by-division/{divisionId}', [App\Http\Controllers\API\SearchController::class, 'getDistrictByDivision']);
Route::get('/get-all-upozilla-by-district/{districtId}', [App\Http\Controllers\API\SearchController::class, 'getUpozillaByDivision']);
Route::get('/get-filter-news/{divisionId}/{districtId?}/{upozillaId?}', [App\Http\Controllers\API\SearchController::class, 'filterNews']);

/**
 * Weare
 */
Route::get('/get-all-weare', [App\Http\Controllers\API\WeAreController::class, 'getAllWeAre']);

/**
 * archive
 */
Route::group(['prefix' => 'archive'], function () {
    Route::get('index/{limit}/{skip?}', [\App\Http\Controllers\API\ArchiveController::class, 'index']);
    Route::post('filter', [\App\Http\Controllers\API\ArchiveController::class, 'filter']);
});

/**
 * timeline
 */
Route::get('/get-timeline-news/{timelineId}/{limit}', [App\Http\Controllers\API\TimelineController::class, 'getTimelineNews']);

/**
 * news keyword
 */
Route::get('/get-keyword-news/{keywordId}/{limit}/{skip?}', [App\Http\Controllers\API\KeywordController::class, 'getNewsByKeyword']);
Route::get('/get-related-news/{newsId}/{limit}/{skip?}', [App\Http\Controllers\API\KeywordController::class, 'relatedNews']);

/**
 * trending news
 */
Route::get('/get-all-trending/{limit}/{skip?}', [App\Http\Controllers\API\TrendingController::class, 'allTrending']);
Route::get('/get-trending-news/{keywordId}/{limit}/{skip?}', [App\Http\Controllers\API\KeywordController::class, 'getNewsByKeyword']);
Route::get('/get-trending-details/{id}', [App\Http\Controllers\API\TrendingController::class, 'trendingDetails']);

/**
 * live news
 */
Route::get('/get-all-live-news/{limit}/{skip}', [App\Http\Controllers\API\LiveNewsController::class, 'getAllLiveNews']);
Route::get('/get-live-news/{newsId}/{limit}/{skip}', [App\Http\Controllers\API\LiveNewsController::class, 'getLiveNews']);

/**
 * search news
 */
Route::get('/search/{title}', [App\Http\Controllers\API\SearchController::class, 'getSearchResult']);

/**
 * reders-choice news
 */
Route::get('/readers-choice/{limit}/{skip}', [App\Http\Controllers\API\LatestController::class, 'readersChoice']);

/**
 * cms
 */
Route::get('/cms/{type}', [App\Http\Controllers\API\CMSController::class, 'cms']);

/**
 * advertise
 */
Route::get('/advertise/{type}', [App\Http\Controllers\API\AdvertiseController::class, 'getAdvertise']);

/**
 * seo
 */
Route::get('/seo-page/{type}', [App\Http\Controllers\API\SEOController::class, 'getPageSeo']);
Route::get('/seo-news/{newsId}', [App\Http\Controllers\API\SEOController::class, 'getNewsSeo']);

/**
 * marquee
 */
Route::get('/get-marquee/{date}', [App\Http\Controllers\API\MarqueeController::class, 'getNews']);