<?php

declare(strict_types=1);

return [
    'swagger_php' => [
        'scanDirs' => [
            __DIR__ . '/MockPhpFiles'
        ],
        'jsonUrl' => '/api-oas-docs/json',
    ],
    'routes' => [
        'swagger_php.route.json' => [
            'path' => '/api-oas-docs/json',
            'middleware' => [
                \Genxoft\SwaggerPhpModule\Handler\JsonAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        'swagger_php.route.ui' => [
            'path' => '/api-oas-docs/ui',
            'middleware' => [
                \Genxoft\SwaggerPhpModule\Handler\UiAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
    ],
    'templates' => [
        'extension' => 'phtml',
        'paths'     => [
            'layout' => __DIR__ . '/view/layout',
            'error' => __DIR__ . '/view/error',
        ],
    ]
];
