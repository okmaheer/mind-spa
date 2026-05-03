<?php

namespace App\Services;

use App\Models\QuizAttempt;
use App\Models\QuizQuestion;

class QuizService
{
    public function getQuestions(string $category, int $limit = 10, string $ageGroup = 'all'): \Illuminate\Support\Collection
    {
        return QuizQuestion::fetchForQuiz($category, $limit, $ageGroup);
    }

    public function scoreQuiz(array $questions, array $userAnswers): array
    {
        $score   = 0;
        $results = [];

        foreach ($questions as $question) {
            $id         = $question['id'];
            $userAnswer = strtolower($userAnswers[$id] ?? '');
            $correct    = strtolower($question['correct_option']);
            $isCorrect  = $userAnswer === $correct;

            if ($isCorrect) $score++;

            $results[] = [
                'id'          => $id,
                'question'    => $question['question'],
                'user_answer' => $userAnswer,
                'correct'     => $correct,
                'is_correct'  => $isCorrect,
                'explanation' => $question['explanation'] ?? null,
                'options'     => [
                    'a' => $question['option_a'],
                    'b' => $question['option_b'],
                    'c' => $question['option_c'],
                    'd' => $question['option_d'],
                ],
            ];
        }

        return [
            'score'       => $score,
            'total'       => count($questions),
            'percent'     => count($questions) ? round(($score / count($questions)) * 100) : 0,
            'results'     => $results,
            'grade'       => $this->grade($score, count($questions)),
            'message'     => $this->message($score, count($questions)),
        ];
    }

    public function recordAttempt(string $sessionId, string $category, int $score, int $total, ?int $timeSecs = null): QuizAttempt
    {
        return QuizAttempt::record($sessionId, $category, $score, $total, $timeSecs);
    }

    private function grade(int $score, int $total): string
    {
        if ($total === 0) return 'N/A';
        $pct = ($score / $total) * 100;
        return match(true) {
            $pct >= 90 => 'A+',
            $pct >= 80 => 'A',
            $pct >= 70 => 'B',
            $pct >= 60 => 'C',
            $pct >= 50 => 'D',
            default    => 'F',
        };
    }

    private function message(int $score, int $total): string
    {
        if ($total === 0) return '';
        $pct = ($score / $total) * 100;
        return match(true) {
            $pct >= 90 => 'Outstanding! You really know your stuff.',
            $pct >= 70 => 'Great job! You scored well above average.',
            $pct >= 50 => 'Not bad — a little more practice and you\'ll nail it.',
            default    => 'Keep going. Every expert was once a beginner.',
        };
    }
}
