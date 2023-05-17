<?php

return [
    'name' => 'LaravelPWA',
    'manifest' => [
        'name' => env('Medicjoo'),
        'short_name' => 'Medicjoo',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => 'https://medicjoo.com/images/icons2/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => 'https://medicjoo.com/images/icons2/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => 'https://medicjoo.com/images/icons2/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => 'https://medicjoo.com/images/icons2/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => 'https://medicjoo.com/images/icons2/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => 'https://medicjoo.com/images/icons2/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => 'https://medicjoo.com/images/icons2/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => 'https://medicjoo.com/images/icons2/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => 'https://medicjoo.com/images/icons2/splash-640x1136.png',
            '750x1334' => 'https://medicjoo.com/images/icons2/splash-750x1334.png',
            '828x1792' => 'https://medicjoo.com/images/icons2/splash-828x1792.png',
            '1125x2436' => 'https://medicjoo.com/images/icons2/splash-1125x2436.png',
            '1242x2208' => 'https://medicjoo.com/images/icons2/splash-1242x2208.png',
            '1242x2688' => 'https://medicjoo.com/images/icons2/splash-1242x2688.png',
            '1536x2048' => 'https://medicjoo.com/images/icons2/splash-1536x2048.png',
            '1668x2224' => 'https://medicjoo.com/images/icons2/splash-1668x2224.png',
            '1668x2388' => 'https://medicjoo.com/images/icons2/splash-1668x2388.png',
            '2048x2732' => 'https://medicjoo.com/images/icons2/splash-2048x2732.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "https://medicjoo.com/public/images/icons2/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
