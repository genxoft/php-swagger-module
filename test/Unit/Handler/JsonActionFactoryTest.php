<?php
/**
 * @noinspection PhpUndefinedMethodInspection
 * @noinspection PhpUnhandledExceptionInspection
 */

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Test\Unit\Handler;

use Genxoft\SwaggerPhpModule\Handler\JsonAction;
use Genxoft\SwaggerPhpModule\Handler\JsonActionFactory;
use Genxoft\SwaggerPhpModule\Configuration\Configuration;
use Genxoft\SwaggerPhpModule\Configuration\ConfigurationInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * @internal
 * @coversNothing
 */
final class JsonActionFactoryTest extends TestCase
{
    use ProphecyTrait;

    protected ConfigurationInterface $configuration;

    protected function setUp(): void
    {
        parent::setUp();

        $configurationProphesize = $this->prophesize(ConfigurationInterface::class);
        $configurationProphesize->getScanDirs()->willReturn(['test_dir', 'test_dir2']);

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->configuration = $configurationProphesize->reveal();
    }

    public function testInvokeWithLogger(): void
    {
        $factory = new JsonActionFactory();
        $container = $this->prophesize(ContainerInterface::class);

        $container->has(ConfigurationInterface::class)->willReturn(true);
        $container->get(ConfigurationInterface::class)->willReturn($this->configuration);

        $container->has(LoggerInterface::class)->willReturn(true);
        $container->get(LoggerInterface::class)->willReturn(new NullLogger());

        /** @var ContainerInterface $ci */
        $ci = $container->reveal();
        $jsonAction = $factory($ci);

        self::assertInstanceOf(JsonAction::class, $jsonAction);
    }

    public function testInvokeWithoutLogger(): void
    {
        $factory = new JsonActionFactory();
        $container = $this->prophesize(ContainerInterface::class);

        $container->has(ConfigurationInterface::class)->willReturn(true);
        $container->get(ConfigurationInterface::class)->willReturn($this->configuration);

        $container->has(LoggerInterface::class)->willReturn(false);

        /** @var ContainerInterface $ci */
        $ci = $container->reveal();
        $jsonAction = $factory($ci);

        self::assertInstanceOf(JsonAction::class, $jsonAction);
    }
}
