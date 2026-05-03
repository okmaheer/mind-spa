<?php

namespace App\Http\Controllers;

use App\Services\QuizService;

class KidsController extends Controller
{
    public function __construct(private QuizService $quiz) {}

    public function mathPuzzles()  { return view('kids.math-puzzles'); }
    public function wordGames()    { return view('kids.word-games'); }

    public function scienceQuiz()
    {
        $questions = $this->quiz->getQuestions('science', 10, 'kids');
        return view('kids.science-quiz', compact('questions'));
    }

    public function animalQuiz()
    {
        $questions = $this->quiz->getQuestions('animals', 10, 'kids');
        return view('kids.animal-quiz', compact('questions'));
    }

    public function spellingQuiz() { return view('kids.spelling-quiz'); }
}
