<?php
/**
 * @noinspection PhpUndefinedMethodInspection
 * @noinspection PhpUnhandledExceptionInspection
 */

namespace Genxoft\SwaggerPhpModule\Test\Unit\Handler;

use Genxoft\SwaggerPhpModule\Handler\UiAction;
use Laminas\Diactoros\ServerRequest;
use Mezzio\Helper\ServerUrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

class UiActionTest extends TestCase
{
    use ProphecyTrait;

    protected TemplateRendererInterface $templateRenderer;

    protected function setUp(): void
    {
        parent::setUp();

        $templateRendererProphesize = $this->prophesize(TemplateRendererInterface::class);

        $templateRendererProphesize->render('swagger-ui::index', Argument::type('array'))
            ->will(function ($args) {
                Assert::assertIsArray($args[1]);
                Assert::assertArrayHasKey('oasJsonUrl', $args[1]);
                return 'string';
            });


        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->templateRenderer = $templateRendererProphesize->reveal();
    }


    public function testHandleWithUrlHelper()
    {
        $urlHelper = new ServerUrlHelper();

        $uiAction = new UiAction($this->templateRenderer, $urlHelper, 'test_json_url');

        /** @var \Laminas\Diactoros\Response\HtmlResponse $response */
        $response = $uiAction->handle(new ServerRequest());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('text/html; charset=utf-8', $response->getHeader('Content-type')[0]);
    }

    public function testHandleWithoutUrlHelper()
    {
        $uiAction = new UiAction($this->templateRenderer, null, 'test_json_url');

        /** @var \Laminas\Diactoros\Response\HtmlResponse $response */
        $response = $uiAction->handle(new ServerRequest());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('text/html; charset=utf-8', $response->getHeader('Content-type')[0]);
    }
}
