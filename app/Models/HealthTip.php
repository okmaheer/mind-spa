<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class HealthTip extends Model
{
    public $timestamps = false;

    protected $fillable = ['tip', 'category', 'day_number'];

    public static function ofDay(): ?self
    {
        $dayNumber = (int) date('z') + 1; // 1–365

        return Cache::remember("health_tip:{$dayNumber}", now()->secondsUntilEndOfDay(), function () use ($dayNumber) {
            return self::where('day_number', $dayNumber)->first()
                ?? self::inRandomOrder()->first();
        });
    }
}
