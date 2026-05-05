<?php

namespace App\Http\Controllers;

class GamesController extends Controller
{
    public function typingSpeed()   { return $this->renderOrComingSoon('games.typing-speed-test'); }
    public function reactionTime()  { return $this->renderOrComingSoon('games.reaction-time-test'); }
    public function memoryTest()    { return $this->renderOrComingSoon('games.memory-test'); }
    public function wordScramble()  { return $this->renderOrComingSoon('games.word-scramble'); }
    public function colorBlind()    { return $this->renderOrComingSoon('games.color-blind-test'); }
}
