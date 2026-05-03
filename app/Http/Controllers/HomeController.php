<?php

namespace App\Http\Controllers;

use App\Models\HealthTip;
use App\Models\SearchQuery;
use App\Models\Tool;
use App\Services\SeoService;
use App\Services\SitemapService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __construct(private SeoService $seo) {}

    public function index()
    {
        $popularTools = Tool::getPopular(6);
        $healthTip   = HealthTip::ofDay();

        return view('home', compact('popularTools', 'healthTip'));
    }

    public function search(Request $request)
    {
        $q     = trim($request->get('q', ''));
        $tools = [];

        if (strlen($q) >= 2) {
            $all   = Tool::allForSearch();
            $lower = strtolower($q);

            $tools = array_filter($all, fn ($t) =>
                str_contains(strtolower($t['name']), $lower) ||
                str_contains(strtolower($t['description']), $lower)
            );
            $tools = array_values($tools);

            SearchQuery::log($q, count($tools));
        }

        if ($request->wantsJson()) {
            return response()->json(['results' => $tools, 'query' => $q]);
        }

        return view('search', compact('tools', 'q'));
    }

    public function sitemap()
    {
        $xml = Cache::remember('sitemap:xml', now()->addHours(6), function () {
            return (new SitemapService())->generate();
        });

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    public function about()
    {
        return view('static.about');
    }

    public function privacy()
    {
        return view('static.privacy');
    }

    public function sleepGuide()
    {
        return view('seo.what-time-should-i-sleep');
    }

    public function sleepNeedsGuide()
    {
        return view('seo.how-much-sleep-do-i-need');
    }

    public function bmiGuide()
    {
        return view('seo.what-is-a-good-bmi');
    }

    public function caloriesGuide()
    {
        return view('seo.calories-to-lose-weight');
    }
}
