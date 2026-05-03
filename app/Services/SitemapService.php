<?php

namespace App\Services;

use App\Models\Tool;

class SitemapService
{
    private array $staticRoutes = [
        ['loc' => '/',                        'priority' => '1.0', 'changefreq' => 'daily'],
        ['loc' => '/sleep-tools',             'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/fitness-tools',           'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/nutrition-tools',         'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/quizzes',                 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/kids',                    'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => '/life-tools',              'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => '/games',                   'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => '/iq-test',                 'priority' => '0.9', 'changefreq' => 'monthly'],
        ['loc' => '/what-time-should-i-sleep','priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => '/how-much-sleep-do-i-need','priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => '/what-is-a-good-bmi',      'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => '/calories-to-lose-weight', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => '/about',                   'priority' => '0.3', 'changefreq' => 'yearly'],
        ['loc' => '/privacy',                 'priority' => '0.3', 'changefreq' => 'yearly'],
    ];

    public function generate(): string
    {
        $base  = rtrim(config('app.url'), '/');
        $items = $this->staticRoutes;

        // Append tool slugs dynamically
        $tools = Tool::active()->get(['slug', 'updated_at']);
        foreach ($tools as $tool) {
            $items[] = [
                'loc'        => '/' . $tool->slug,
                'priority'   => '0.8',
                'changefreq' => 'monthly',
                'lastmod'    => optional($tool->updated_at)->toDateString(),
            ];
        }

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($items as $item) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$base}{$item['loc']}</loc>\n";
            $xml .= "    <changefreq>{$item['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$item['priority']}</priority>\n";
            if (!empty($item['lastmod'])) {
                $xml .= "    <lastmod>{$item['lastmod']}</lastmod>\n";
            }
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';
        return $xml;
    }
}
