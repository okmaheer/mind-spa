<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class QuizQuestion extends Model
{
    protected $fillable = [
        'category', 'question', 'option_a', 'option_b', 'option_c', 'option_d',
        'correct_option', 'explanation', 'difficulty', 'age_group', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    // ── Scopes ────────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeForAgeGroup($query, string $ageGroup)
    {
        return $query->whereIn('age_group', [$ageGroup, 'all']);
    }

    public function scopeByDifficulty($query, string $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    // ── Cached Fetchers ───────────────────────────────────────────────────────

    public static function fetchForQuiz(string $category, int $limit = 10, string $ageGroup = 'all'): \Illuminate\Support\Collection
    {
        $cacheKey = "quiz:questions:{$category}:{$ageGroup}";

        $questions = Cache::remember($cacheKey, now()->addHour(), function () use ($category, $ageGroup) {
            return self::active()
                ->forCategory($category)
                ->forAgeGroup($ageGroup)
                ->inRandomOrder()
                ->get();
        });

        return $questions->shuffle()->take($limit);
    }

    public static function fetchByIds(array $ids): \Illuminate\Support\Collection
    {
        return self::whereIn('id', $ids)->active()->get();
    }

    public function getOptionsAttribute(): array
    {
        return [
            'a' => $this->option_a,
            'b' => $this->option_b,
            'c' => $this->option_c,
            'd' => $this->option_d,
        ];
    }
}
