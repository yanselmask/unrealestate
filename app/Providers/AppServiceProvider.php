<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Str::macro('readingMinutes', function ($subject, $wordPerMinute = 200) {
            return intval(ceil(Str::wordCount(strip_tags($subject)) / $wordPerMinute));
        });
    }
}
