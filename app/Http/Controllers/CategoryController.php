<?php

namespace App\Http\Controllers;

use App\Models\Tool;

class CategoryController extends Controller
{
    private function categoryView(string $category, string $view): \Illuminate\View\View
    {
        $tools = Tool::forCategory($category);
        return view($view, compact('tools', 'category'));
    }

    public function sleep()    { return $this->categoryView('sleep',     'categories.sleep'); }
    public function fitness()  { return $this->categoryView('fitness',   'categories.fitness'); }
    public function nutrition(){ return $this->categoryView('nutrition', 'categories.nutrition'); }

    public function kids()     { return $this->categoryView('kids',      'categories.kids'); }
    public function life()     { return $this->categoryView('life',      'categories.life'); }
    public function games()    { return $this->categoryView('games',     'categories.games'); }
}
