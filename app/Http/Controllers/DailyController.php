<?php

namespace App\Http\Controllers;

use App\Models\DailyQuiz;
use App\Models\HealthTip;

class DailyController extends Controller
{
    public function index()
    {
        $dailyQuiz = DailyQuiz::today();
        $healthTip = HealthTip::ofDay();

        return view('daily.index', compact('dailyQuiz', 'healthTip'));
    }
}
