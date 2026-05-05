<?php

namespace App\Http\Middleware;

use App\Services\PublishableRegistry;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforcePublished
{
    public function handle(Request $request, Closure $next): Response
    {
        // Only check GET requests — POST/PUT etc. are form submissions, not page loads
        // Skip for logged-in admin so they can preview unpublished tools
        if ($request->isMethod('GET') && ! auth()->check()) {
            if (PublishableRegistry::isUnpublishedPath($request->path())) {
                return response()->view('errors.coming-soon', [], 404);
            }
        }

        return $next($request);
    }
}
