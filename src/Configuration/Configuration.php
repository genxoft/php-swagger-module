<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Configuration;

use Genxoft\SwaggerPhpModule\Exception\InvalidScanDirException;
use Genxoft\SwaggerPhpModule\Exception\RequireParamException;

final class Configuration implements ConfigurationInterface
{
    /**
     * @var array<string>
     */
    private array $scanDirs = [];

    private string $jsonUrl;

    /**
     * @throws InvalidScanDirException
     * @throws RequireParamException
     */
    public function __construct(array $parameters)
    {
        if (!\array_key_exists('scanDirs', $parameters) || !\is_array($parameters['scanDirs'])) {
            throw new RequireParamException('scanDirs param is required');
        }
        $this->setScanDirs($parameters['scanDirs']);

        if (!\array_key_exists('jsonUrl', $parameters) || !\is_string($parameters['jsonUrl'])) {
            throw new RequireParamException('jsonUrl param is required');
        }
        $this->setJsonUrl($parameters['jsonUrl']);
    }

    /**
     * @param array<string> $dirs
     * @return void
     * @throws InvalidScanDirException
     */
    public function setScanDirs(array $dirs): void
    {
        array_map(static function ($dir): void {
            if (!\is_string($dir)) {
                throw new InvalidScanDirException();
            }
        }, $dirs);
        $this->scanDirs = $dirs;
    }

    /**
     * {@inheritDoc}
     */
    public function getScanDirs(): array
    {
        return $this->scanDirs;
    }

    /**
     * @param string $url
     * @return void
     */
    private function setJsonUrl(string $url): void
    {
        $this->jsonUrl = $url;
    }

    /**
     * {@inheritDoc}
     */
    public function getJsonUrl(): string
    {
        return $this->jsonUrl;
    }
}
