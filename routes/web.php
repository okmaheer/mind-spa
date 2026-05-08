<?php

use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KidsController;

use Illuminate\Support\Facades\Route;

// ── Core ──────────────────────────────────────────────────────────────────────

Route::get('/',          [HomeController::class, 'index'])->name('home');
Route::get('/search',    [HomeController::class, 'search'])->name('search');
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/about',     [HomeController::class, 'about'])->name('about');
Route::get('/privacy',   [HomeController::class, 'privacy'])->name('privacy');

Route::get('/robots.txt', function () {
    $lines = app()->isProduction() ? [
        'User-agent: *',
        'Allow: /',
        'Disallow: /admin',
        'Disallow: /admin/',
        'Disallow: /api',
        'Disallow: /login',
        'Disallow: /register',
        'Disallow: /password',
        'Disallow: /storage',
        '',
        'Sitemap: ' . url('/sitemap.xml'),
    ] : [
        'User-agent: *',
        'Disallow: /',
    ];

    return response(implode("\n", $lines), 200)
        ->header('Content-Type', 'text/plain');
})->name('robots');

// ── Category Pages ────────────────────────────────────────────────────────────

Route::get('/sleep-tools',       [CategoryController::class, 'sleep'])->name('category.sleep');
Route::get('/fitness-tools',     [CategoryController::class, 'fitness'])->name('category.fitness');
Route::get('/nutrition-tools',   [CategoryController::class, 'nutrition'])->name('category.nutrition');

Route::get('/mental-health-tools',[CategoryController::class, 'mentalHealth'])->name('category.mental-health');
Route::get('/productivity-tools',[CategoryController::class, 'productivity'])->name('category.productivity');
Route::get('/study-tools',       [CategoryController::class, 'study'])->name('category.study');
Route::get('/pet-tools',         [CategoryController::class, 'pets'])->name('category.pets');

Route::get('/kids',              [CategoryController::class, 'kids'])->name('category.kids');
Route::get('/life-tools',        [CategoryController::class, 'life'])->name('category.life');
Route::get('/games',             [CategoryController::class, 'games'])->name('category.games');

// ── Sleep Tools ───────────────────────────────────────────────────────────────

Route::get('/sleep-calculator',           [CalculatorController::class, 'sleep'])->name('calc.sleep');
Route::get('/wake-up-calculator',         [CalculatorController::class, 'wakeUp'])->name('calc.wakeup');
Route::get('/nap-calculator',             [CalculatorController::class, 'nap'])->name('calc.nap');
Route::get('/baby-sleep-calculator',      [CalculatorController::class, 'babySleep'])->name('calc.baby-sleep');
Route::get('/sleep-debt-calculator',      [CalculatorController::class, 'sleepDebt'])->name('calc.sleep-debt');
Route::get('/caffeine-sleep-calculator',  [CalculatorController::class, 'caffeine'])->name('calc.caffeine');
Route::get('/jet-lag-calculator',         [CalculatorController::class, 'jetLag'])->name('calc.jet-lag');
Route::get('/sleep-quality-quiz',         [CalculatorController::class, 'sleepQuality'])->name('calc.sleep-quality');

// ── Fitness Tools ─────────────────────────────────────────────────────────────

Route::get('/bmi-calculator',             [CalculatorController::class, 'bmi'])->name('calc.bmi');
Route::get('/calorie-calculator',         [CalculatorController::class, 'calorie'])->name('calc.calorie');
Route::get('/calorie-deficit-calculator', [CalculatorController::class, 'calorieDeficit'])->name('calc.calorie-deficit');
Route::get('/macro-calculator',           [CalculatorController::class, 'macro'])->name('calc.macro');
Route::get('/protein-calculator',         [CalculatorController::class, 'protein'])->name('calc.protein');
Route::get('/one-rep-max-calculator',     [CalculatorController::class, 'oneRepMax'])->name('calc.one-rep-max');
Route::get('/body-fat-calculator',        [CalculatorController::class, 'bodyFat'])->name('calc.body-fat');
Route::get('/heart-rate-calculator',      [CalculatorController::class, 'heartRate'])->name('calc.heart-rate');
Route::get('/running-pace-calculator',    [CalculatorController::class, 'runningPace'])->name('calc.running-pace');
Route::get('/ideal-weight-calculator',    [CalculatorController::class, 'idealWeight'])->name('calc.ideal-weight');
Route::get('/workout-volume-calculator',  [CalculatorController::class, 'workoutVolume'])->name('calc.workout-volume');

// ── Nutrition Tools ───────────────────────────────────────────────────────────

Route::get('/water-intake-calculator',          [CalculatorController::class, 'waterIntake'])->name('calc.water-intake');
Route::get('/intermittent-fasting-calculator',  [CalculatorController::class, 'intermittentFasting'])->name('calc.if');

// ── Life Tools ────────────────────────────────────────────────────────────────

Route::get('/age-calculator',             [CalculatorController::class, 'age'])->name('calc.age');
Route::get('/days-between-dates',         [CalculatorController::class, 'daysBetween'])->name('calc.days-between');
Route::get('/days-until-calculator',      [CalculatorController::class, 'daysUntil'])->name('calc.days-until');
Route::get('/due-date-calculator',        [CalculatorController::class, 'dueDate'])->name('calc.due-date');
Route::get('/ovulation-calculator',       [CalculatorController::class, 'ovulation'])->name('calc.ovulation');
Route::get('/retirement-calculator',      [CalculatorController::class, 'retirement'])->name('calc.retirement');
Route::get('/life-percentage-calculator', [CalculatorController::class, 'lifePercentage'])->name('calc.life-percent');


// ── Mental Health Tools ───────────────────────────────────────────────────────

Route::get('/attachment-style-quiz',    [CalculatorController::class, 'attachmentStyleQuiz'])->name('calc.attachment-style');
Route::get('/anxiety-quiz',             [CalculatorController::class, 'anxietyQuiz'])->name('calc.anxiety');
Route::get('/depression-screening',     [CalculatorController::class, 'depressionScreening'])->name('calc.depression');

// ── Productivity Tools ────────────────────────────────────────────────────────

Route::get('/pomodoro-timer',           [CalculatorController::class, 'pomodoroTimer'])->name('calc.pomodoro');

// ── Study Tools ───────────────────────────────────────────────────────────────

Route::get('/reading-speed-test',       [CalculatorController::class, 'readingSpeedTest'])->name('calc.reading-speed');

// ── Pet Tools ─────────────────────────────────────────────────────────────────

Route::get('/dog-age-calculator',       [CalculatorController::class, 'dogAge'])->name('calc.dog-age');
Route::get('/cat-age-calculator',       [CalculatorController::class, 'catAge'])->name('calc.cat-age');

// ── Kids Zone ─────────────────────────────────────────────────────────────────

Route::get('/kids/math-puzzles',    [KidsController::class, 'mathPuzzles'])->name('kids.math');
Route::get('/kids/word-games',      [KidsController::class, 'wordGames'])->name('kids.words');
Route::get('/kids/science-quiz',    [KidsController::class, 'scienceQuiz'])->name('kids.science');
Route::get('/kids/animal-quiz',     [KidsController::class, 'animalQuiz'])->name('kids.animals');
Route::get('/kids/spelling-quiz',   [KidsController::class, 'spellingQuiz'])->name('kids.spelling');

// ── Games ─────────────────────────────────────────────────────────────────────

Route::get('/typing-speed-test',    [GamesController::class, 'typingSpeed'])->name('games.typing');
Route::get('/reaction-time-test',   [GamesController::class, 'reactionTime'])->name('games.reaction');
Route::get('/memory-test',          [GamesController::class, 'memoryTest'])->name('games.memory');
Route::get('/word-scramble',        [GamesController::class, 'wordScramble'])->name('games.scramble');
Route::get('/color-blind-test',     [GamesController::class, 'colorBlind'])->name('games.color-blind');


