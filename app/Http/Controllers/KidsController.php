<?php

namespace App\Http\Controllers;

class KidsController extends Controller
{
    public function mathPuzzles()  { return $this->renderOrComingSoon('kids.math-puzzles'); }
    public function wordGames()    { return $this->renderOrComingSoon('kids.word-games'); }
    public function scienceQuiz()  { return $this->renderOrComingSoon('kids.science-quiz'); }
    public function animalQuiz()   { return $this->renderOrComingSoon('kids.animal-quiz'); }
    public function spellingQuiz() { return $this->renderOrComingSoon('kids.spelling-quiz'); }
}
