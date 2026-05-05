<?php

namespace App\Http\Middleware;

use App\Services\PublishableRegistry;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SeoHeaders
{
    // Cache durations in seconds for Cloudflare's Cache-Control header
    private const TTL = [
        'home'       => 3600,   // 1 hour
        'category'   => 3600,
        'calculator' => 86400,  // 24 hours — static content, formulas don't change
        'game'       => 86400,
        'seo'        => 86400,
        'quiz'       => 300,    // 5 min — quiz questions should feel fresh
        'default'    => 600,
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET') && $response->isSuccessful()) {
            $path = $request->path();
            $ttl  = $this->ttlForPath($path);
            $response->headers->set('Cache-Control', "public, max-age={$ttl}, s-maxage={$ttl}");
            $response->headers->set('X-Robots-Tag', $this->resolveRobotsTag($path));
            $response->headers->set('Vary', 'Accept-Encoding');
        }

        return $response;
    }

    private function resolveRobotsTag(string $path): string
    {
        // Admin area must never be indexed — HTTP header overrides any <meta robots> tag
        if ($path === 'admin' || str_starts_with($path, 'admin/')) {
            return 'noindex, nofollow';
        }

        // Unpublished tools/content
        if (PublishableRegistry::isUnpublishedPath($path)) {
            return 'noindex, nofollow';
        }

        return 'index, follow';
    }

    private function ttlForPath(string $path): int
    {
        if ($path === '/')                              return self::TTL['home'];
        if (str_ends_with($path, '-tools'))            return self::TTL['category'];
        if (str_contains($path, 'calculator'))         return self::TTL['calculator'];
        if (str_contains($path, 'quiz') || str_contains($path, 'iq-test')) return self::TTL['quiz'];
        if (str_contains($path, '-test') || $path === 'games') return self::TTL['game'];
        if (str_starts_with($path, 'what-') || str_starts_with($path, 'how-') || str_starts_with($path, 'calories-')) return self::TTL['seo'];
        return self::TTL['default'];
    }
}
