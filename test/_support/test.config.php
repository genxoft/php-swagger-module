<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Test\_support;

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

$config = new ConfigAggregator([
    \Mezzio\ConfigProvider::class,
    \Genxoft\SwaggerPhpModule\ConfigProvider::class,
    \Mezzio\Router\ConfigProvider::class,
    \Mezzio\ProblemDetails\ConfigProvider::class,
    \Mezzio\LaminasView\ConfigProvider::class,
    \Mezzio\Router\FastRouteRouter\ConfigProvider::class,
    ConfigProvider::class,
    new PhpFileProvider(__DIR__ . '/../../config/module.config.php'),
    new PhpFileProvider(__DIR__ . '/app.config.php'),

]);
return $config->getMergedConfig();
