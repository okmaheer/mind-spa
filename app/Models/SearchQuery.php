<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchQuery extends Model
{
    public $timestamps = false;

    protected $fillable = ['query', 'results_count', 'created_at'];

    protected $casts = ['created_at' => 'datetime'];

    public static function log(string $query, int $resultsCount): void
    {
        self::create([
            'query'         => mb_strtolower(trim($query)),
            'results_count' => $resultsCount,
            'created_at'    => now(),
        ]);
    }

    public static function trending(int $days = 7, int $limit = 10): array
    {
        return self::select('query', \Illuminate\Support\Facades\DB::raw('COUNT(*) as searches'))
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('query')
            ->orderByDesc('searches')
            ->limit($limit)
            ->pluck('query')
            ->toArray();
    }
}
