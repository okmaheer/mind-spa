<?php

namespace App\Http\Controllers;

use App\Models\Tool;

abstract class Controller
{
    protected function renderOrComingSoon(string $view): \Illuminate\Http\Response|\Illuminate\View\View
    {
        $slug = str($view)->afterLast('.')->toString();
        $tool = Tool::where('slug', $slug)->first();

        if ($tool && ! $tool->isPublished()) {
            // 503 tells Google "temporarily unavailable" — it keeps the URL in the index.
            // 404 would cause Google to drop the page, which is bad for tools that will be published later.
            return response()->view('errors.coming-soon', [], 503)
                ->withHeaders([
                    'Cache-Control' => 'no-store, no-cache, must-revalidate',
                    'Retry-After'   => '86400',
                ]);
        }

        if (! \Illuminate\Support\Facades\View::exists($view)) {
            return response()->view('errors.coming-soon', [], 404)
                ->withHeaders(['Cache-Control' => 'no-store, no-cache, must-revalidate']);
        }

        return view($view);
    }
}
