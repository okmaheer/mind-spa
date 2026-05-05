<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'     => Tool::count(),
            'published' => Tool::published()->count(),
            'draft'     => Tool::draft()->count(),
            'scheduled' => Tool::scheduled()->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
