<?php

namespace App\Providers;

use App\Http\Middleware\SeoHeaders;
use App\Services\SeoService;
use App\Services\QuizService;
use App\Services\SitemapService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SeoService::class);
        $this->app->singleton(QuizService::class);
        $this->app->singleton(SitemapService::class);
    }

    public function boot(): void
    {
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
