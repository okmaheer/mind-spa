<?php

namespace App\Providers;

use App\Models\Tool;
use App\Services\PublishableRegistry;
use App\Services\SeoService;
use App\Services\SitemapService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SeoService::class);
        $this->app->singleton(SitemapService::class);
    }

    public function boot(): void
    {
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            URL::forceRootUrl(config('app.url'));
        }

        // Register single-segment tool slugs (e.g. "sleep-calculator", "bmi-calculator")
        PublishableRegistry::register(
            '/^([a-z0-9-]+)$/',
            fn($m) => Tool::where('slug', $m[1])->select('published_at', 'is_active')->first()
        );

        // Future blog posts — uncomment when BlogPost model exists:
        // PublishableRegistry::register(
        //     '/^blog\/([a-z0-9-]+)$/',
        //     fn($m) => \App\Models\BlogPost::where('slug', $m[1])->select('published_at')->first()
        // );
    }
}
