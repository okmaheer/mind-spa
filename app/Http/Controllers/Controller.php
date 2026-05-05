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
            return response()->view('errors.coming-soon', [], 404);
        }

        if (! \Illuminate\Support\Facades\View::exists($view)) {
            return response()->view('errors.coming-soon', [], 404);
        }

        return view($view);
    }
}
