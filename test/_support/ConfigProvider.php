<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Test\_support;

use Laminas\Stratigility\Middleware\ErrorHandler;
use Mezzio\Application;
use Mezzio\Container\ApplicationConfigInjectionDelegator;
use Mezzio\Handler\NotFoundHandler;
use Mezzio\Router\Middleware\DispatchMiddleware;
use Mezzio\Router\Middleware\MethodNotAllowedMiddleware;
use Mezzio\Router\Middleware\RouteMiddleware;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'delegators' => [
                    Application::class => [
                        ApplicationConfigInjectionDelegator::class,
                    ],
                ],
            ],
            'middleware_pipeline' => [
                [
                    'middleware' => [
                        ErrorHandler::class,
                        RouteMiddleware::class,
                        MethodNotAllowedMiddleware::class,
                        DispatchMiddleware::class,
                        NotFoundHandler::class,
                    ],
                ],
            ],
         ];
    }
}
