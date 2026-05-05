<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function renderOrComingSoon(string $view): \Illuminate\Http\Response|\Illuminate\View\View
    {
        if (! \Illuminate\Support\Facades\View::exists($view)) {
            return response()->view('errors.coming-soon', [], 404);
        }

        return view($view);
    }
}
