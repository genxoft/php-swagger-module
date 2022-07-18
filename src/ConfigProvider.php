<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return include __DIR__.'/../config/module.config.php';
    }
}
