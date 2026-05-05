<?php

namespace App\Console\Commands;

use App\Models\Tool;
use App\Services\PublishableRegistry;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SyncPublishedStatus extends Command
{
    protected $signature   = 'mindsnap:sync-published';
    protected $description = 'Unpublish any tool whose view file does not exist.';

    public function handle(): int
    {
        $tools      = Tool::published()->get();
        $unpublished = 0;

        foreach ($tools as $tool) {
            if (! $tool->viewExists()) {
                $tool->unpublish();
                PublishableRegistry::clearCache($tool->slug);
                $this->line("  Unpublished: <comment>{$tool->name}</comment> ({$tool->slug})");
                $unpublished++;
            }
        }

        if ($unpublished > 0) {
            Cache::forget('tools:nav');
            Cache::forget('tools:search');
            Cache::forget('tools:popular:6');
            Cache::forget('sitemap:xml');
        }

        $this->info("Done — {$unpublished} tool(s) unpublished, " . ($tools->count() - $unpublished) . ' already had views.');

        return self::SUCCESS;
    }
}
