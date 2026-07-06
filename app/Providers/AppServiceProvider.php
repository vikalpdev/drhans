<?php

namespace App\Providers;

use App\Models\Centre;
use App\Models\Treatment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['components.header', 'components.footer'], function ($view) {
            $view->with('navCentres', Cache::remember('nav.centres', 3600, fn () => Centre::orderBy('order')->get()));
            $view->with('navTreatments', Cache::remember('nav.treatments', 3600, fn () => Treatment::orderBy('order')->get()));
        });
    }
}
