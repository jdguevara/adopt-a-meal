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
            'App\Repositories\VolunteerFormRepository'
        );
        $this->app->bind(
            'App\Contracts\ICalendarService',
            'App\Services\CalendarService'
        );
        $this->app->bind(
            'App\Contracts\IMealIdeaRepository',
            'App\Repositories\MealIdeaRepository'
        );
        $this->app->bind(
            'App\Contracts\IMessagesRepository',
            'App\Repositories\MessagesRepository'
        );
        $this->app->bind(
            'App\Contracts\IEmailService',
            'App\Services\EmailService'
        );
        $this->app->bind(
            'App\Contracts\IUserRepository',
            'App\Repositories\UserRepository'
        );
    }
}