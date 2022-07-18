<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Handler;

use Genxoft\SwaggerPhpModule\Configuration\ConfigurationInterface;
use Genxoft\SwaggerPhpModule\Exception\TemplateRendererRequiredException;
use Mezzio\Helper\ServerUrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

final class UiActionFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \Genxoft\SwaggerPhpModule\Handler\UiAction
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Genxoft\SwaggerPhpModule\Exception\TemplateRendererRequiredException
     */
    public function __invoke(ContainerInterface $container): UiAction
    {
        if ($container->has(TemplateRendererInterface::class)) {
            /** @var TemplateRendererInterface $renderer */
            $renderer = $container->get(TemplateRendererInterface::class);
        } else {
            throw new TemplateRendererRequiredException("Template Renderer is required");
        }

        if ($container->has(ServerUrlHelper::class)) {
            $urlHelper = $container->get(ServerUrlHelper::class);
        } else {
            $urlHelper = null;
        }

        /** @var ConfigurationInterface $configuration */
        $configuration = $container->get(ConfigurationInterface::class);

        return new UiAction($renderer, $urlHelper, $configuration->getJsonUrl());
    }
}
