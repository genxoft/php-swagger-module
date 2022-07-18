<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule;

final class Module
{
    public function getConfig(): array
    {
        $configProvider = new ConfigProvider();
        $config = $configProvider();

        $config['service_manager'] = $config['dependencies'];
        unset($config['dependencies']);

        return $config;
    }
}
