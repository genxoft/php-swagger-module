<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Test\Unit;

use Genxoft\SwaggerPhpModule\ConfigProvider;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class ConfigProviderTest extends TestCase
{
    private ConfigProvider $configProvider;

    protected function setUp(): void
    {
        $this->configProvider = new ConfigProvider();
    }

    public function testConfigRequireParamsTest(): void
    {
        $config = ($this->configProvider)();

        self::assertArrayHasKey('dependencies', $config);
        self::assertArrayHasKey('templates', $config);
        self::assertArrayHasKey('asset_manager', $config);
    }
}
