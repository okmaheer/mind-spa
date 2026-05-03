<?php

namespace App\Console\Commands;

use App\Services\SitemapService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GenerateSitemap extends Command
{
    protected $signature   = 'mindsnap:sitemap';
    protected $description = 'Regenerate sitemap.xml and clear cache';

    public function handle(SitemapService $sitemap): int
    {
        Cache::forget('sitemap:xml');

        $xml  = $sitemap->generate();
        $path = public_path('sitemap.xml');

        file_put_contents($path, $xml);

        $this->info('Sitemap generated: ' . $path);
        return self::SUCCESS;
    }
}
