<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ── Scheduled Tasks ───────────────────────────────────────────────────────────

// Generate tomorrow's daily quiz every night at 23:00
Schedule::command('mindsnap:daily-quiz')->dailyAt('23:00');

// Regenerate sitemap weekly (Sunday 02:00)
Schedule::command('mindsnap:sitemap')->weekly()->sundays()->at('02:00');
