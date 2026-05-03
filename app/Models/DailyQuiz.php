<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class DailyQuiz extends Model
{
    protected $fillable = ['date', 'topic', 'difficulty', 'question_ids', 'is_active'];

    protected $casts = [
        'date'         => 'date',
        'question_ids' => 'array',
        'is_active'    => 'boolean',
    ];

    public static function today(): ?self
    {
        return Cache::remember('daily_quiz:today', now()->secondsUntilEndOfDay(), function () {
            return self::where('date', today())
                ->where('is_active', true)
                ->first();
        });
    }

    public function getQuestionsAttribute(): \Illuminate\Support\Collection
    {
        return QuizQuestion::fetchByIds($this->question_ids);
    }
}
