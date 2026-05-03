<?php

namespace App\Http\Controllers;

use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    private const VALID_CATEGORIES = [
        'general-knowledge', 'history', 'biology', 'science',
        'geography', 'math', 'world-war-2', 'human-body',
    ];

    public function __construct(private QuizService $quiz) {}

    public function show(string $category)
    {
        if (!in_array($category, self::VALID_CATEGORIES, true)) {
            abort(404);
        }

        $questions = $this->quiz->getQuestions($category);

        return view('quizzes.quiz', compact('questions', 'category'));
    }

    public function iqTest()
    {
        $questions = $this->quiz->getQuestions('iq', 20);
        return view('quizzes.iq-test', compact('questions'));
    }

    public function saveResult(Request $request)
    {
        $validated = $request->validate([
            'category'          => 'required|string|max:50',
            'score'             => 'required|integer|min:0|max:100',
            'total_questions'   => 'required|integer|min:1|max:50',
            'time_taken_seconds'=> 'nullable|integer|min:0|max:7200',
        ]);

        $attempt = $this->quiz->recordAttempt(
            session()->getId(),
            $validated['category'],
            $validated['score'],
            $validated['total_questions'],
            $validated['time_taken_seconds'] ?? null,
        );

        return response()->json(['status' => 'ok', 'attempt_id' => $attempt->id]);
    }
}
