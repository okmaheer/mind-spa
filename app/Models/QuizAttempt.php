<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'session_id', 'category', 'score', 'total_questions',
        'time_taken_seconds', 'completed_at',
    ];

    protected $casts = ['completed_at' => 'datetime'];

    public static function record(string $sessionId, string $category, int $score, int $total, ?int $timeSecs = null): self
    {
        return self::create([
            'session_id'       => $sessionId,
            'category'         => $category,
            'score'            => $score,
            'total_questions'  => $total,
            'time_taken_seconds' => $timeSecs,
            'completed_at'     => now(),
        ]);
    }

    public function getScorePercentAttribute(): int
    {
        if ($this->total_questions === 0) return 0;
        return (int) round(($this->score / $this->total_questions) * 100);
    }
}
