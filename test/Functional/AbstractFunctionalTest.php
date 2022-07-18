<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Test\Functional;

use Laminas\ServiceManager\ServiceManager;
use Mezzio\Application;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

abstract class AbstractFunctionalTest extends TestCase
{
    protected ContainerInterface $container;
    protected Application $app;

    protected function setUp(): void
    {
        parent::setUp();

        $this->initContainer(include __DIR__ . '/../_support/test.config.php');
        $this->initApp();
    }

    protected function initContainer(array $config): void
    {
        $dependencies = $config['dependencies'];
        $dependencies['services']['config'] = $config;
        $this->container = new ServiceManager($dependencies);
    }

    protected function initApp(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->app = $this->container->get(Application::class);
    }
}
