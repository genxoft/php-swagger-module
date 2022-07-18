<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Handler;

use Mezzio\Helper\ServerUrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class UiAction implements RequestHandlerInterface
{
    private TemplateRendererInterface $renderer;
    private string $oasJsonUrl;
    private ?ServerUrlHelper $urlHelper;

    /**
     * @param TemplateRendererInterface $renderer
     * @param ServerUrlHelper|null $urlHelper
     * @param string $oasJsonUrl
     */
    public function __construct(TemplateRendererInterface $renderer, ?ServerUrlHelper $urlHelper, string $oasJsonUrl)
    {
        $this->renderer = $renderer;
        $this->urlHelper = $urlHelper ?? null;
        $this->oasJsonUrl = $oasJsonUrl;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->renderer->render(
            'swagger-ui::index',
            [
                'basePath'   => $this->urlHelper ? $this->urlHelper->generate('/') : '/',
                'oasJsonUrl' => $this->oasJsonUrl,
            ]
        ));
    }
}
