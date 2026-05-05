<?php

namespace App\Models;

use App\Traits\HasPublishing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tool extends Model
{
    use HasPublishing;

    protected $attributes = [
        'published_at' => null,
    ];

    protected $fillable = [
        'name', 'slug', 'category', 'type', 'icon', 'description',
        'meta_description', 'h1', 'page_title', 'keywords',
        'monthly_searches', 'sort_order', 'is_active', 'show_in_nav',
        'published_at',
    ];

    protected $casts = [
        'keywords'         => 'array',
        'is_active'        => 'boolean',
        'show_in_nav'      => 'boolean',
        'monthly_searches' => 'integer',
        'published_at'     => 'datetime',
    ];

    // ── Scopes ───────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeNavVisible($query)
    {
        return $query->where('show_in_nav', true)->where('is_active', true);
    }

    public function scopePopular($query, int $limit = 6)
    {
        return $query->active()->orderByDesc('monthly_searches')->limit($limit);
    }

    // ── Cached Accessors ──────────────────────────────────────────────────────

    public static function allForNav(): array
    {
        return Cache::remember('tools:nav', now()->addDay(), function () {
            return self::navVisible()
                ->published()
                ->orderBy('category')
                ->orderBy('sort_order')
                ->get(['id', 'name', 'slug', 'category', 'icon', 'description'])
                ->groupBy('category')
                ->toArray();
        });
    }

    public static function allForSearch(): array
    {
        return Cache::remember('tools:search', now()->addDay(), function () {
            return self::active()
                ->published()
                ->orderByDesc('monthly_searches')
                ->get(['name', 'slug', 'category', 'description', 'icon'])
                ->toArray();
        });
    }

    public static function getPopular(int $limit = 6): array
    {
        return Cache::remember("tools:popular:{$limit}", now()->addHours(6), function () use ($limit) {
            return self::active()
                ->published()
                ->orderByDesc('monthly_searches')
                ->limit($limit)
                ->get()
                ->toArray();
        });
    }

    public static function forCategory(string $category): array
    {
        return Cache::remember("tools:category:{$category}", now()->addHours(6), function () use ($category) {
            return self::active()->published()->category($category)->orderBy('sort_order')->get()->toArray();
        });
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    public function getUrlAttribute(): string
    {
        return url($this->slug);
    }

    public function viewExists(): bool
    {
        $slug = $this->slug;

        if (str_contains($slug, '/')) {
            // Multi-segment slug like "kids/math-puzzles" → views/kids/math-puzzles.blade.php
            return file_exists(resource_path("views/{$slug}.blade.php"));
        }

        return file_exists(resource_path("views/calculators/{$slug}.blade.php"))
            || file_exists(resource_path("views/games/{$slug}.blade.php"));
    }
}
