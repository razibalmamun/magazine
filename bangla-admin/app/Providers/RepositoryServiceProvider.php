<?php

namespace App\Providers;

use App\Http\Helper\Helper;
use App\Http\Repositories\HelperRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(HelperRepositoryInterface::class,Helper::class);
    }
}
