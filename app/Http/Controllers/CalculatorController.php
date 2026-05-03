<?php

namespace App\Http\Controllers;

use App\Services\SeoService;
use Illuminate\Support\Facades\View;

class CalculatorController extends Controller
{
    public function __construct(private SeoService $seo) {}

    private function renderOrAbort(string $view): \Illuminate\View\View
    {
        abort_unless(View::exists($view), 404);
        return view($view);
    }

    // ── Sleep Tools ─────────────────────────────────────────────────────────

    public function sleep()           { return view('calculators.sleep-calculator'); }
    public function wakeUp()          { return view('calculators.wake-up-calculator'); }
    public function nap()             { return view('calculators.nap-calculator'); }
    public function babySleep()       { return view('calculators.baby-sleep-calculator'); }
    public function sleepDebt()       { return view('calculators.sleep-debt-calculator'); }
    public function caffeine()        { return view('calculators.caffeine-sleep-calculator'); }
    public function jetLag()          { return view('calculators.jet-lag-calculator'); }
    public function sleepQuality()    { return view('calculators.sleep-quality-quiz'); }

    // ── Fitness Tools ───────────────────────────────────────────────────────

    public function bmi()             { return $this->renderOrAbort('calculators.bmi-calculator'); }
    public function calorie()         { return $this->renderOrAbort('calculators.calorie-calculator'); }
    public function calorieDeficit()  { return $this->renderOrAbort('calculators.calorie-deficit-calculator'); }
    public function macro()           { return $this->renderOrAbort('calculators.macro-calculator'); }
    public function protein()         { return $this->renderOrAbort('calculators.protein-calculator'); }
    public function oneRepMax()       { return $this->renderOrAbort('calculators.one-rep-max-calculator'); }
    public function bodyFat()         { return $this->renderOrAbort('calculators.body-fat-calculator'); }
    public function heartRate()       { return $this->renderOrAbort('calculators.heart-rate-calculator'); }
    public function runningPace()     { return $this->renderOrAbort('calculators.running-pace-calculator'); }
    public function idealWeight()     { return $this->renderOrAbort('calculators.ideal-weight-calculator'); }
    public function workoutVolume()   { return $this->renderOrAbort('calculators.workout-volume-calculator'); }

    // ── Nutrition Tools ─────────────────────────────────────────────────────

    public function waterIntake()         { return $this->renderOrAbort('calculators.water-intake-calculator'); }
    public function intermittentFasting() { return $this->renderOrAbort('calculators.intermittent-fasting-calculator'); }

    // ── Life Tools ──────────────────────────────────────────────────────────

    public function age()             { return $this->renderOrAbort('calculators.age-calculator'); }
    public function daysBetween()     { return $this->renderOrAbort('calculators.days-between-dates'); }
    public function daysUntil()       { return $this->renderOrAbort('calculators.days-until-calculator'); }
    public function dueDate()         { return $this->renderOrAbort('calculators.due-date-calculator'); }
    public function ovulation()       { return $this->renderOrAbort('calculators.ovulation-calculator'); }
    public function retirement()      { return $this->renderOrAbort('calculators.retirement-calculator'); }
    public function lifePercentage()  { return $this->renderOrAbort('calculators.life-percentage-calculator'); }
}
