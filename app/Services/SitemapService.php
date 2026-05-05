<?php

namespace App\Services;

use App\Models\Tool;
use Illuminate\Support\Facades\Log;

class SitemapService
{
    private array $staticRoutes = [
        ['loc' => '/',                        'priority' => '1.0', 'changefreq' => 'daily'],
        ['loc' => '/sleep-tools',             'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/fitness-tools',           'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/nutrition-tools',         'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/kids',                    'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => '/life-tools',              'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => '/games',                   'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => '/iq-test',                 'priority' => '0.9', 'changefreq' => 'monthly'],
        ['loc' => '/about',                   'priority' => '0.3', 'changefreq' => 'yearly'],
        ['loc' => '/privacy',                 'priority' => '0.3', 'changefreq' => 'yearly'],
    ];

    public function generate(): string
    {
        $base  = rtrim(config('app.url'), '/');
        $items = $this->staticRoutes;

        Log::info('[SITEMAP] Starting sitemap generation', ['base_url' => $base]);
        Log::info('[SITEMAP] Static routes count: ' . count($this->staticRoutes));

        // Append tool slugs dynamically from database
        try {
            $tools = Tool::active()->published()->get(['slug', 'updated_at']);
            Log::info('[SITEMAP] Active+published tools query executed', ['count' => $tools->count()]);

            if ($tools->count() === 0) {
                Log::warning('[SITEMAP] No active published tools found in database');
                $totalTools  = Tool::count();
                $activeCount = Tool::where('is_active', 1)->count();
                Log::warning('[SITEMAP] Total tools: ' . $totalTools . ', active: ' . $activeCount);
            }
            
            foreach ($tools as $tool) {
                // Try to find the view file directly
                $viewPath = resource_path("views/calculators/{$tool->slug}.blade.php");
                
                if (!file_exists($viewPath)) {
                    Log::warning('[SITEMAP] View file not found for tool', ['slug' => $tool->slug, 'path' => $viewPath]);
                    continue;
                }
                
                Log::debug('[SITEMAP] Adding tool to sitemap', [
                    'slug' => $tool->slug,
                    'updated_at' => $tool->updated_at
                ]);
                
                $items[] = [
                    'loc'        => '/' . $tool->slug,
                    'priority'   => '0.8',
                    'changefreq' => 'monthly',
                    'lastmod'    => $tool->updated_at?->toDateString(),
                ];
            }
            
            Log::info('[SITEMAP] Total items in sitemap (static + tools): ' . count($items));
            
        } catch (\Exception $e) {
            Log::error('[SITEMAP] Error fetching tools', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
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
        
        Log::info('[SITEMAP] Sitemap generation completed', ['xml_size' => strlen($xml), 'total_urls' => count($items)]);
        
        return $xml;
    }
}
