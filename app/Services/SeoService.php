<?php

namespace App\Services;

class SeoService
{
    // ── Schema Builders ────────────────────────────────────────────────────────

    public function webApplicationSchema(string $name, string $slug): array
    {
        return [
            '@context'            => 'https://schema.org',
            '@type'               => 'WebApplication',
            'name'                => "{$name} | MindSnap",
            'url'                 => url($slug),
            'applicationCategory' => 'HealthApplication',
            'operatingSystem'     => 'Any',
            'offers'              => [
                '@type'         => 'Offer',
                'price'         => '0',
                'priceCurrency' => 'USD',
            ],
        ];
    }

    public function breadcrumbSchema(array $crumbs): array
    {
        $items = [];
        foreach ($crumbs as $i => $crumb) {
            $items[] = [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'name'     => $crumb['name'],
                'item'     => $crumb['url'],
            ];
        }

        return [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }

    public function faqSchema(array $faqs): array
    {
        $entities = array_map(fn ($faq) => [
            '@type'          => 'Question',
            'name'           => $faq['question'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['answer'],
            ],
        ], $faqs);

        return [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $entities,
        ];
    }

    public function websiteSchema(): array
    {
        return [
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            'name'            => 'MindSnap',
            'url'             => config('app.url'),
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => config('app.url') . '/search?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    public function toolPageSchemas(string $toolName, string $slug, array $breadcrumbs, array $faqs): string
    {
        $schemas = [
            $this->webApplicationSchema($toolName, $slug),
            $this->breadcrumbSchema($breadcrumbs),
            $this->faqSchema($faqs),
        ];

        return collect($schemas)
            ->map(fn ($s) => '<script type="application/ld+json">' . json_encode($s, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>')
            ->implode("\n");
    }

    // ── Title / Meta Helpers ──────────────────────────────────────────────────

    public function toolTitle(string $toolName): string
    {
        $title = "{$toolName} — Free Online Calculator | MindSnap";
        return mb_strlen($title) > 60 ? mb_substr($title, 0, 57) . '...' : $title;
    }

    public function quizTitle(string $topic, int $questions = 10): string
    {
        return "{$topic} Quiz — {$questions} Questions Free | MindSnap";
    }

    public function categoryTitle(string $category): string
    {
        return "Free {$category} Tools Online | MindSnap";
    }

    // ── Canonical URL ─────────────────────────────────────────────────────────

    public function canonical(string $path = ''): string
    {
        return rtrim(config('app.url'), '/') . '/' . ltrim($path, '/');
    }

    // ── Standard Tool Breadcrumbs ─────────────────────────────────────────────

    public function toolBreadcrumbs(string $categoryName, string $categorySlug, string $toolName, string $toolSlug): array
    {
        return [
            ['name' => 'Home',         'url' => config('app.url')],
            ['name' => $categoryName,  'url' => $this->canonical($categorySlug)],
            ['name' => $toolName,      'url' => $this->canonical($toolSlug)],
        ];
    }
}
