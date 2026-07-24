<?php

namespace App\Providers;

use App\Models\Centre;
use App\Models\ConditionTreated;
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
            $view->with('navCentres', Cache::remember('nav.centres', 3600, fn () => Centre::where('is_active', true)->orderBy('order')->get()));
            $view->with('navTreatments', Cache::remember('nav.treatments', 3600, fn () => Treatment::orderBy('order')->get()));
            $view->with('navConditionGroups', Cache::remember('nav.condition-groups', 3600, function () {
                $conditions = ConditionTreated::where('show_in_menu', true)->orderBy('order')->get()->groupBy('category');

                return collect(ConditionTreated::CATEGORIES)
                    ->map(fn ($label, $key) => ['key' => $key, 'label' => $label, 'items' => $conditions->get($key, collect())])
                    ->filter(fn ($group) => $group['items']->isNotEmpty())
                    ->values();
            }));
        });
    }
}
