<?php

namespace App\Providers;

use App\Http\Services\VolunteerFormRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\IVolunteerFormRepository',
            'App\Services\VolunteerFormRepository'
        );
        $this->app->bind(
            'App\Contracts\ICalendarRepository',
            'App\Services\CalendarRepository'
        );
        $this->app->bind(
            'App\Contracts\IMealIdeaRepository',
            'App\Services\MealIdeaRepository'
        );
    }
}