<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::get('access-denied', [\App\Http\Controllers\HomeController::class, 'accessDenied'])->name('access-denied');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/news-position',function(){
        return view('admin.news-system.index');
    });
    Route::group(['prefix' => 'news'], function () {
        Route::get('index', [\App\Http\Controllers\NewsController::class, 'index']);
        Route::get('most-readed', [\App\Http\Controllers\NewsController::class, 'MostRead']);
        Route::get('create', [\App\Http\Controllers\NewsController::class, 'create']);
        Route::post('store', [\App\Http\Controllers\NewsController::class, 'store']);
        Route::post('update', [\App\Http\Controllers\NewsController::class, 'update']);
        Route::get('publish/{newsId}', [\App\Http\Controllers\NewsController::class, 'publish'])->middleware('publisher');
        Route::get('proofreader/{newsId}', [\App\Http\Controllers\NewsController::class, 'proofreader'])->middleware('publisher');
        Route::get('list/proofreader', [\App\Http\Controllers\NewsController::class, 'listProofreader']);
        Route::get('proofreader/submit/{newsId}', [\App\Http\Controllers\NewsController::class, 'submitProofreader']);
        Route::get('get-district/{divisionID}', [\App\Http\Controllers\NewsController::class, 'getDistrictByDivId']);
        Route::get('get-upozilla/{districtID}', [\App\Http\Controllers\NewsController::class, 'getUpozillaByDisId']);
        Route::get('live-news/list', [\App\Http\Controllers\NewsController::class, 'getListLiveNews']);
        Route::get('live-index/{newsId}', [\App\Http\Controllers\NewsController::class, 'liveNews']);
        Route::post('live-index/store', [\App\Http\Controllers\NewsController::class, 'liveNewsStore']);
        Route::get('live-news/edit/{newsId}', [\App\Http\Controllers\NewsController::class, 'liveNewsEdit']);
        Route::get('live-news/delete/{newsId}', [\App\Http\Controllers\NewsController::class, 'liveNewsDelete'])->name('live.news.delete');
        Route::post('live-news/update', [\App\Http\Controllers\NewsController::class, 'liveNewsUpdate']);


        /**
         * order news
         */
        Route::get('order-news', [\App\Http\Controllers\NewsController::class, 'orderNews']);
        Route::post('order-news-store', [\App\Http\Controllers\NewsController::class, 'orderNewsStore']);
        Route::post('orderUpdate', [\App\Http\Controllers\NewsController::class, 'orderUpdate']);

        Route::get('create-by-category/{categoryId}/{categoryName}', [\App\Http\Controllers\NewsController::class, 'createByCategory']);
        Route::get('index-by-category/{categoryId}', [\App\Http\Controllers\NewsController::class, 'getList']);
        Route::delete('delete/{newsId}/', [\App\Http\Controllers\NewsController::class, 'delete']);
        Route::get('edit/{newsId}/{categoryName?}', [\App\Http\Controllers\NewsController::class, 'edit']);
        Route::get('view/{newsId}/', [\App\Http\Controllers\NewsController::class, 'view']);
        Route::get('keyword-by-id/{newsId}/', [\App\Http\Controllers\NewsController::class, 'getKeyWord']);
        Route::get('get-keyword', [\App\Http\Controllers\Keyword::class, 'getKeyword']);

        Route::group(['prefix' => 'category', 'middleware' => 'developer'], function () {
            Route::get('index', [\App\Http\Controllers\Category::class, 'index']);
            Route::post('create', [\App\Http\Controllers\Category::class, 'create']);
            Route::get('list', [\App\Http\Controllers\Category::class, 'list']);
            Route::get('view/{id}', [\App\Http\Controllers\Category::class, 'view']);
            Route::get('edit/{id}', [\App\Http\Controllers\Category::class, 'edit']);
            Route::post('update', [\App\Http\Controllers\Category::class, 'update']);
            Route::get('delete/{id}', [\App\Http\Controllers\Category::class, 'delete']);
            Route::get('visible/{id}', [\App\Http\Controllers\Category::class, 'visible']);
            Route::get('invisible/{id}', [\App\Http\Controllers\Category::class, 'invisible']);
        });

        Route::group(['prefix' => 'subcategory', 'middleware' => 'developer'], function () {
            Route::get('index', [\App\Http\Controllers\Subcategory::class, 'index']);
            Route::post('create', [\App\Http\Controllers\Subcategory::class, 'create']);
            Route::get('list', [\App\Http\Controllers\Subcategory::class, 'list']);
            Route::get('view/{id}', [\App\Http\Controllers\Subcategory::class, 'view']);
            Route::get('edit/{id}', [\App\Http\Controllers\Subcategory::class, 'edit']);
            Route::post('update', [\App\Http\Controllers\Subcategory::class, 'update']);
            Route::get('delete/{id}', [\App\Http\Controllers\Subcategory::class, 'delete']);
            Route::get('get-sub-category/{categoryId}', [\App\Http\Controllers\Subcategory::class, 'getSubCategory']);
            Route::post('get-sub-category-post/', [\App\Http\Controllers\Subcategory::class, 'getSubCategoryByJson']);
            Route::get('visible/{id}', [\App\Http\Controllers\Subcategory::class, 'visible']);
            Route::get('invisible/{id}', [\App\Http\Controllers\Subcategory::class, 'invisible']);
        });

        Route::group(['prefix' => 'keyword', 'middleware' => 'developer'], function () {
            Route::get('index', [\App\Http\Controllers\Keyword::class, 'index']);
            Route::get('index-trending', [\App\Http\Controllers\Keyword::class, 'indexTrending']);
            Route::post('create', [\App\Http\Controllers\Keyword::class, 'create']);
            Route::get('list', [\App\Http\Controllers\Keyword::class, 'list']);
            Route::get('view/{id}', [\App\Http\Controllers\Keyword::class, 'view']);
            Route::get('edit/{id}', [\App\Http\Controllers\Keyword::class, 'edit']);
            Route::post('update', [\App\Http\Controllers\Keyword::class, 'update']);
            Route::get('delete/{id}', [\App\Http\Controllers\Keyword::class, 'delete']);
            Route::get('make-trending/{id}', [\App\Http\Controllers\Keyword::class, 'makeTrending']);
            Route::get('remove-trending/{id}', [\App\Http\Controllers\Keyword::class, 'removeTrending']);
            Route::get('details-trending/{id}', [\App\Http\Controllers\Keyword::class, 'detailsTrending']);
            Route::post('trending-details-store', [\App\Http\Controllers\Keyword::class, 'detailsStoreTrending']);
        });

        Route::group(['prefix' => 'video', 'middleware' => 'developer'], function () {
            Route::get('index', [\App\Http\Controllers\VideoController::class, 'index']);
            Route::post('create', [\App\Http\Controllers\VideoController::class, 'create']);
            Route::get('list', [\App\Http\Controllers\VideoController::class, 'list']);
            Route::get('view/{id}', [\App\Http\Controllers\VideoController::class, 'view']);
            Route::get('edit/{id}', [\App\Http\Controllers\VideoController::class, 'edit']);
            Route::post('update', [\App\Http\Controllers\VideoController::class, 'update']);
            Route::get('delete/{id}', [\App\Http\Controllers\VideoController::class, 'delete']);
        });


        Route::group(['prefix' => 'image', 'middleware' => 'developer'], function () {
            Route::get('index', [\App\Http\Controllers\ImageController::class, 'index']);
            Route::post('create', [\App\Http\Controllers\ImageController::class, 'create']);
            Route::get('list', [\App\Http\Controllers\ImageController::class, 'list']);
            Route::get('view/{id}', [\App\Http\Controllers\ImageController::class, 'view']);
            Route::get('edit/{id}', [\App\Http\Controllers\ImageController::class, 'edit']);
            Route::post('update', [\App\Http\Controllers\ImageController::class, 'update']);
            Route::get('delete/{id}', [\App\Http\Controllers\ImageController::class, 'delete']);
        });
    });
    Route::group(['prefix' => 'vote', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\VoteController::class, 'index']);
        Route::get('create', [\App\Http\Controllers\VoteController::class, 'create']);
        Route::post('store', [\App\Http\Controllers\VoteController::class, 'store']);
        Route::get('list', [\App\Http\Controllers\VoteController::class, 'list']);
        Route::get('edit/{id}', [\App\Http\Controllers\VoteController::class, 'edit']);
        Route::get('activate/{id}', [\App\Http\Controllers\VoteController::class, 'activate']);
        Route::get('deactivate/{id}', [\App\Http\Controllers\VoteController::class, 'deactivate']);
        Route::post('update', [\App\Http\Controllers\VoteController::class, 'update']);
        Route::get('delete/{id}', [\App\Http\Controllers\VoteController::class, 'delete']);
    });
    Route::group(['prefix' => 'opinion', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\OpinionController::class, 'index']);
        Route::post('create', [\App\Http\Controllers\OpinionController::class, 'create']);
        Route::get('list', [\App\Http\Controllers\OpinionController::class, 'list']);
        Route::get('view/{id}', [\App\Http\Controllers\OpinionController::class, 'view']);
        Route::get('edit/{id}', [\App\Http\Controllers\OpinionController::class, 'edit']);
        Route::post('update', [\App\Http\Controllers\OpinionController::class, 'update']);
        Route::get('delete/{id}', [\App\Http\Controllers\OpinionController::class, 'delete']);
    });
    Route::group(['prefix' => 'seo', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\SeoController::class, 'index']);
        Route::get('create', [\App\Http\Controllers\SeoController::class, 'create']);
        Route::post('store', [\App\Http\Controllers\SeoController::class, 'store']);
        Route::get('view/{id}', [\App\Http\Controllers\SeoController::class, 'view']);
        Route::get('edit/{id}', [\App\Http\Controllers\SeoController::class, 'edit']);
        Route::post('update', [\App\Http\Controllers\SeoController::class, 'update']);
        Route::get('delete/{id}', [\App\Http\Controllers\SeoController::class, 'delete']);
    });

    Route::group(['prefix' => 'information', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\InformationController::class, 'index']);
        Route::get('edit', [\App\Http\Controllers\InformationController::class, 'edit']);
        Route::post('store', [\App\Http\Controllers\InformationController::class, 'update']);
    });

    Route::group(['prefix' => 'contact', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\ContactController::class, 'index']);
        Route::get('create', [\App\Http\Controllers\ContactController::class, 'create']);
        Route::post('store', [\App\Http\Controllers\ContactController::class, 'store']);
        Route::get('delete/{id}', [\App\Http\Controllers\ContactController::class, 'delete']);
    });

    Route::group(['prefix' => 'user', 'middleware' => 'admin'], function () {
        Route::get('index', [\App\Http\Controllers\UserController::class, 'index']);
        Route::get('create', [\App\Http\Controllers\UserController::class, 'create']);
        Route::post('store', [\App\Http\Controllers\UserController::class, 'store']);
        Route::post('update', [\App\Http\Controllers\UserController::class, 'update'])->middleware('admin');
        Route::get('delete/{id}', [\App\Http\Controllers\UserController::class, 'delete'])->middleware('admin');
        Route::get('edit/{id}', [\App\Http\Controllers\UserController::class, 'edit'])->middleware('admin');
    });

    Route::get('profile', [\App\Http\Controllers\UserController::class, 'profile']);
    Route::post('profile-update', [\App\Http\Controllers\UserController::class, 'profileUpdate']);

    Route::group(['prefix' => 'designation', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\DesignationController::class, 'index']);
        Route::post('store', [\App\Http\Controllers\DesignationController::class, 'store']);
        Route::get('delete/{id}', [\App\Http\Controllers\DesignationController::class, 'delete']);
    });

    Route::group(['prefix' => 'timeline', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\TimelineController::class, 'index']);
        Route::post('store', [\App\Http\Controllers\TimelineController::class, 'store']);
        Route::get('delete/{id}', [\App\Http\Controllers\TimelineController::class, 'delete']);
        Route::get('news/{id}', [\App\Http\Controllers\TimelineController::class, 'timelineNews']);
        Route::get('news/remove/{id}', [\App\Http\Controllers\TimelineController::class, 'removeNews']);
        Route::get('getTimeline/{id?}', [\App\Http\Controllers\TimelineController::class, 'getTimeline']);
    });

    Route::group(['prefix' => 'division', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\DivisionController::class, 'index']);
        Route::post('store', [\App\Http\Controllers\DivisionController::class, 'store']);
        Route::post('update', [\App\Http\Controllers\DivisionController::class, 'update']);
        Route::get('delete/{id}', [\App\Http\Controllers\DivisionController::class, 'delete']);
        Route::get('edit/{id}', [\App\Http\Controllers\DivisionController::class, 'edit']);
    });

    Route::group(['prefix' => 'weare', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\WeAreController::class, 'index']);
        Route::get('create', [\App\Http\Controllers\WeAreController::class, 'create']);
        Route::get('edit/{id}', [\App\Http\Controllers\WeAreController::class, 'edit']);
        Route::post('store', [\App\Http\Controllers\WeAreController::class, 'store']);
        Route::post('update/', [\App\Http\Controllers\WeAreController::class, 'update']);
        Route::get('delete/{id}', [\App\Http\Controllers\WeAreController::class, 'delete']);
    });

    Route::group(['prefix' => 'cms', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\CMSController::class, 'index']);
        Route::get('view/{id}', [\App\Http\Controllers\CMSController::class, 'view']);
        Route::get('edit/{id}', [\App\Http\Controllers\CMSController::class, 'edit']);
        Route::post('update', [\App\Http\Controllers\CMSController::class, 'update']);
    });

    Route::group(['prefix' => 'advertise', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\AdvertiseController::class, 'index']);
        Route::get('create', [\App\Http\Controllers\AdvertiseController::class, 'create']);
        Route::get('view/{id}', [\App\Http\Controllers\AdvertiseController::class, 'view']);
        Route::get('edit/{id}', [\App\Http\Controllers\AdvertiseController::class, 'edit']);
        Route::post('store', [\App\Http\Controllers\AdvertiseController::class, 'store']);
        Route::post('update', [\App\Http\Controllers\AdvertiseController::class, 'update']);
        Route::get('active/{id}', [\App\Http\Controllers\AdvertiseController::class, 'makeActive']);
        Route::post('active/{id}', [\App\Http\Controllers\AdvertiseController::class, 'delete']);
    });

    Route::group(['prefix' => 'gallery', 'middleware' => 'developer'], function () {
        Route::get('index', [\App\Http\Controllers\GalleryController::class, 'index']);
        Route::get('create', [\App\Http\Controllers\GalleryController::class, 'create']);
        Route::post('save', [\App\Http\Controllers\GalleryController::class, 'save']);
    });
});

URL::forceScheme('https');

require __DIR__ . '/auth.php';
