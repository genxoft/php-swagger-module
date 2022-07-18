<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Configuration;

use Psr\Container\ContainerInterface;

final class ConfigurationFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \Genxoft\SwaggerPhpModule\Configuration\Configuration
     *
     * @throws \Genxoft\SwaggerPhpModule\Exception\InvalidScanDirException
     * @throws \Genxoft\SwaggerPhpModule\Exception\RequireParamException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): Configuration
    {
        $parameters = $container->get('config')[ConfigurationInterface::CONFIGURATION_IDENTIFIER] ?? [];

        return new Configuration($parameters);
    }
}
