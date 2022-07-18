<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule;

return [
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ . '/../asset/',
            ],
        ],
    ],
    'dependencies' => [
        'factories' => [
            Configuration\Configuration::class => Configuration\ConfigurationFactory::class,
            Handler\JsonAction::class => Handler\JsonActionFactory::class,
            Handler\UiAction::class => Handler\UiActionFactory::class,
        ],
        'aliases' => [
            Configuration\ConfigurationInterface::class => Configuration\Configuration::class,
        ],
    ],
    'templates' => [
        'paths'     => [
            'swagger-ui' => __DIR__ . '/../view/swagger-ui',
        ],
    ]
];
