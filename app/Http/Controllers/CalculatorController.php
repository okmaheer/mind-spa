<?php

namespace App\Http\Controllers;

use App\Services\SeoService;

class CalculatorController extends Controller
{
    public function __construct(private SeoService $seo) {}

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

    public function bmi()             { return view('calculators.bmi-calculator'); }
    public function calorie()         { return view('calculators.calorie-calculator'); }
    public function calorieDeficit()  { return view('calculators.calorie-deficit-calculator'); }
    public function macro()           { return view('calculators.macro-calculator'); }
    public function protein()         { return view('calculators.protein-calculator'); }
    public function oneRepMax()       { return view('calculators.one-rep-max-calculator'); }
    public function bodyFat()         { return view('calculators.body-fat-calculator'); }
    public function heartRate()       { return view('calculators.heart-rate-calculator'); }
    public function runningPace()     { return view('calculators.running-pace-calculator'); }
    public function idealWeight()     { return view('calculators.ideal-weight-calculator'); }
    public function workoutVolume()   { return view('calculators.workout-volume-calculator'); }

    // ── Nutrition Tools ─────────────────────────────────────────────────────

    public function waterIntake()         { return view('calculators.water-intake-calculator'); }
    public function intermittentFasting() { return view('calculators.intermittent-fasting-calculator'); }

    // ── Life Tools ──────────────────────────────────────────────────────────

    public function age()             { return view('calculators.age-calculator'); }
    public function daysBetween()     { return view('calculators.days-between-dates'); }
    public function daysUntil()       { return view('calculators.days-until-calculator'); }
    public function dueDate()         { return view('calculators.due-date-calculator'); }
    public function ovulation()       { return view('calculators.ovulation-calculator'); }
    public function retirement()      { return view('calculators.retirement-calculator'); }
    public function lifePercentage()  { return view('calculators.life-percentage-calculator'); }
}
