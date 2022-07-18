<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Configuration;

interface ConfigurationInterface
{
    public const CONFIGURATION_IDENTIFIER = 'swagger_php';

    /**
     * @return array<string>
     */
    public function getScanDirs(): array;

    /**
     * @return string
     */
    public function getJsonUrl(): string;
}
