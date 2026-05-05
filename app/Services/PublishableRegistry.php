<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Facades\Cache;

class PublishableRegistry
{
    private static array $resolvers = [];

    /**
     * Register a URL pattern and a closure that resolves the publishable model for that pattern.
     *
     * The closure receives the regex $matches array and must return an Eloquent model instance
     * (with a `published_at` column and `HasPublishing` trait) or null if not found.
     *
     * Example — tools (single-segment slugs):
     *   PublishableRegistry::register('/^([a-z0-9-]+)$/', fn($m) => Tool::where('slug', $m[1])->first());
     *
     * Example — future blog posts:
     *   PublishableRegistry::register('/^blog\/([a-z0-9-]+)$/', fn($m) => BlogPost::where('slug', $m[1])->first());
     */
    public static function register(string $pattern, Closure $resolver): void
    {
        self::$resolvers[$pattern] = $resolver;
    }

    /**
     * Returns true if the given path maps to a registered publishable that is NOT yet published.
     * Uses a 60-second per-path cache to avoid per-request DB hits.
     */
    public static function isUnpublishedPath(string $path): bool
    {
        return Cache::remember("publishable:noindex:{$path}", 60, function () use ($path) {
            foreach (self::$resolvers as $pattern => $resolver) {
                if (preg_match($pattern, $path, $matches)) {
                    $item = $resolver($matches);
                    if ($item !== null) {
                        return ! $item->isPublished();
                    }
                }
            }
            return false;
        });
    }

    public static function clearCache(string $path): void
    {
        Cache::forget("publishable:noindex:{$path}");
    }
}
