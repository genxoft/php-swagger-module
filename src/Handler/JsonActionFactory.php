<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Handler;

use Genxoft\SwaggerPhpModule\Configuration\ConfigurationInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class JsonActionFactory
{
    /**
     * @param ContainerInterface $container
     * @return \Genxoft\SwaggerPhpModule\Handler\JsonAction
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): JsonAction
    {
        /** @var ConfigurationInterface $configuration */
        $configuration = $container->get(ConfigurationInterface::class);
        if ($container->has(LoggerInterface::class)) {
            /** @var LoggerInterface $logger */
            $logger = $container->get(LoggerInterface::class);
        } else {
            $logger = null;
        }

        return new JsonAction(
            $configuration->getScanDirs(),
            $logger,
        );
    }
}
