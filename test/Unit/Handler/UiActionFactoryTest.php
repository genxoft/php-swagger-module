<?php
/**
 * @noinspection PhpUndefinedMethodInspection
 * @noinspection PhpUnhandledExceptionInspection
 */

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Test\Unit\Handler;

use Genxoft\SwaggerPhpModule\Exception\TemplateRendererRequiredException;
use Genxoft\SwaggerPhpModule\Handler\UiAction;
use Genxoft\SwaggerPhpModule\Handler\UiActionFactory;
use Genxoft\SwaggerPhpModule\Configuration\ConfigurationInterface;
use Mezzio\Helper\ServerUrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Container\ContainerInterface;

class UiActionFactoryTest extends TestCase
{
    use ProphecyTrait;

    protected ConfigurationInterface $configuration;
    protected TemplateRendererInterface $renderer;

    protected function setUp(): void
    {
        parent::setUp();

        $configurationProphesize = $this->prophesize(ConfigurationInterface::class);
        $configurationProphesize->getJsonUrl()->willReturn('test_json_url');

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->configuration = $configurationProphesize->reveal();

        $rendererProphesize = $this->prophesize(TemplateRendererInterface::class);

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->renderer = $rendererProphesize->reveal();
    }

    public function testInvokeWithTemplateRenderer(): void
    {
        $factory = new UiActionFactory();

        $containerProphesize = $this->prophesize(ContainerInterface::class);

        $containerProphesize->has(TemplateRendererInterface::class)->willReturn(true);
        $containerProphesize->get(TemplateRendererInterface::class)->willReturn($this->renderer);

        $containerProphesize->has(ConfigurationInterface::class)->willReturn(true);
        $containerProphesize->get(ConfigurationInterface::class)->willReturn($this->configuration);

        $containerProphesize->has(ServerUrlHelper::class)->willReturn(true);
        $containerProphesize->get(ServerUrlHelper::class)->willReturn(new ServerUrlHelper());

        /** @var ContainerInterface $container */
        $container = $containerProphesize->reveal();

        $uiAction = $factory($container);
        self::assertInstanceOf(UiAction::class, $uiAction);
    }

    public function testInvokeWithoutTemplateRenderer(): void
    {
        $factory = new UiActionFactory();

        $containerProphesize = $this->prophesize(ContainerInterface::class);

        $containerProphesize->has(TemplateRendererInterface::class)->willReturn(false);

        $containerProphesize->has(ConfigurationInterface::class)->willReturn(true);
        $containerProphesize->get(ConfigurationInterface::class)->willReturn($this->configuration);

        $containerProphesize->has(ServerUrlHelper::class)->willReturn(false);

        /** @var ContainerInterface $container */
        $container = $containerProphesize->reveal();

        $this->expectException(TemplateRendererRequiredException::class);
        $factory($container);
    }
}
