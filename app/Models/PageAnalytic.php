<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageAnalytic extends Model
{
    public $timestamps = false;

    protected $fillable = ['page_slug', 'date', 'views'];

    public static function increment(string $slug): void
    {
        DB::table('page_analytics')->upsert(
            ['page_slug' => $slug, 'date' => today()->toDateString(), 'views' => 1],
            ['page_slug', 'date'],
            [DB::raw('views = views + 1')]
        );
    }

    public static function topPages(int $days = 30, int $limit = 10): array
    {
        return self::select('page_slug', DB::raw('SUM(views) as total_views'))
            ->where('date', '>=', now()->subDays($days))
            ->groupBy('page_slug')
            ->orderByDesc('total_views')
            ->limit($limit)
            ->get()
            ->toArray();
    }
}
