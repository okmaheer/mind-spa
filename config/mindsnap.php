<?php

return [
    'site_name'   => 'MindSnap',
    'site_url'    => env('APP_URL', 'https://mindsnap.co'),
    'site_slogan' => 'Free Tools for a Sharper Mind & Healthier Life',

    'og_image'   => '/images/og-default.jpg',
    'twitter'    => '@MindSnapCo',

    'categories' => [
        'sleep'          => ['label' => 'Sleep Tools',     'icon' => '😴', 'color' => '#6c63ff', 'slug' => 'sleep-tools'],
        'fitness'        => ['label' => 'Fitness Tools',   'icon' => '💪', 'color' => '#28a745', 'slug' => 'fitness-tools'],
        'nutrition'      => ['label' => 'Nutrition Tools', 'icon' => '🥗', 'color' => '#fd7e14', 'slug' => 'nutrition-tools'],
        'mental-health'  => ['label' => 'Mental Health',  'icon' => '🧠', 'color' => '#e94560', 'slug' => 'mental-health-tools'],
        'productivity'   => ['label' => 'Productivity',   'icon' => '⚡', 'color' => '#0b7285', 'slug' => 'productivity-tools'],
        'study'          => ['label' => 'Study Tools',    'icon' => '📚', 'color' => '#0277bd', 'slug' => 'study-tools'],
        'pets'           => ['label' => 'Pet Tools',      'icon' => '🐾', 'color' => '#5a9e4f', 'slug' => 'pet-tools'],

        'kids'           => ['label' => 'Kids Zone',      'icon' => '👶', 'color' => '#17a2b8', 'slug' => 'kids'],
        'life'           => ['label' => 'Life Tools',     'icon' => '⏰', 'color' => '#6f42c1', 'slug' => 'life-tools'],
        'games'          => ['label' => 'Brain Games',    'icon' => '🎮', 'color' => '#ffc107', 'slug' => 'games'],
    ],
];
