<?php

return [
    'enabled'      => env('ADSENSE_ENABLED', false),
    'publisher_id' => env('ADSENSE_PUBLISHER_ID', ''),

    // Slots — fill these in after AdSense approval
    'slots' => [
        'top_banner'    => env('ADSENSE_SLOT_TOP', ''),
        'mid_content'   => env('ADSENSE_SLOT_MID', ''),
        'sidebar'       => env('ADSENSE_SLOT_SIDEBAR', ''),
        'bottom'        => env('ADSENSE_SLOT_BOTTOM', ''),
    ],

    // Pages where ads are never shown
    'exclude_paths' => [
        'kids', 'kids/*',
    ],
];
