<?php

namespace App\Providers;

use App\Models\ClientsReviews;
//use App\Models\PageAdd;
use App\Models\PageAddition;
use App\Models\ServiceContent;
use App\Models\SideSetting;
use App\Models\HomeContent;
use App\Models\SocialLinks;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}

