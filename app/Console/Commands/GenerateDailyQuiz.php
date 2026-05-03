<?php

namespace App\Console\Commands;

use App\Models\DailyQuiz;
use App\Models\QuizQuestion;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GenerateDailyQuiz extends Command
{
    protected $signature   = 'mindsnap:daily-quiz {--date= : Date in Y-m-d format, defaults to tomorrow}';
    protected $description = 'Generate the daily quiz for a given date';

    private const TOPICS = [
        'General Knowledge', 'History', 'Science', 'Geography',
        'Biology', 'Math', 'Pop Culture', 'World Facts',
        'Human Body', 'Nature', 'Technology', 'Sports',
    ];

    public function handle(): int
    {
        $date = $this->option('date') ?? now()->addDay()->toDateString();

        if (DailyQuiz::where('date', $date)->exists()) {
            $this->info("Daily quiz for {$date} already exists.");
            return self::SUCCESS;
        }

        $topic = self::TOPICS[array_rand(self::TOPICS)];

        // Pick 10 questions from available pool for this topic/date
        $categoryMap = [
            'General Knowledge' => 'general-knowledge',
            'History'           => 'history',
            'Science'           => 'science',
            'Geography'         => 'geography',
            'Biology'           => 'biology',
            'Math'              => 'math',
            'Human Body'        => 'human-body',
        ];

        $category = $categoryMap[$topic] ?? 'general-knowledge';

        $questions = QuizQuestion::active()
            ->where('category', $category)
            ->inRandomOrder()
            ->limit(10)
            ->pluck('id')
            ->toArray();

        if (count($questions) < 5) {
            // Fallback: pull from any category
            $questions = QuizQuestion::active()
                ->inRandomOrder()
                ->limit(10)
                ->pluck('id')
                ->toArray();
        }

        DailyQuiz::create([
            'date'         => $date,
            'topic'        => $topic,
            'difficulty'   => 'medium',
            'question_ids' => $questions,
            'is_active'    => true,
        ]);

        // Clear cache so homepage picks up the new quiz
        Cache::forget('daily_quiz:today');

        $this->info("Daily quiz created for {$date}: {$topic} ({count($questions)} questions)");
        return self::SUCCESS;
    }
}
