<?php

namespace App\Http\Controllers;

class GamesController extends Controller
{
    public function typingSpeed()   { return view('games.typing-speed-test'); }
    public function reactionTime()  { return view('games.reaction-time-test'); }
    public function memoryTest()    { return view('games.memory-test'); }
    public function wordScramble()  { return view('games.word-scramble'); }
    public function colorBlind()    { return view('games.color-blind-test'); }
}
