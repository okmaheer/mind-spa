<?php

namespace App\Http\Controllers;

class KidsController extends Controller
{
    public function mathPuzzles()  { return view('kids.math-puzzles'); }
    public function wordGames()    { return view('kids.word-games'); }
    public function scienceQuiz()  { return view('kids.science-quiz'); }
    public function animalQuiz()   { return view('kids.animal-quiz'); }
    public function spellingQuiz() { return view('kids.spelling-quiz'); }
}
