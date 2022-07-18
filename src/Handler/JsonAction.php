<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use OpenApi\Generator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Finder\Finder;

final class JsonAction implements RequestHandlerInterface
{
    private array $scanDirs;
    private ?LoggerInterface $logger;

    /**
     * @param array<string> $scanDirs
     */
    public function __construct(array $scanDirs, ?LoggerInterface $logger = null)
    {
        $this->scanDirs = $scanDirs;
        $this->logger = $logger ?? null;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $finder = Finder::create()->files()->name('*.php')->in($this->scanDirs);
        $openapi = (new Generator($this->logger))
            ->setAliases(Generator::DEFAULT_ALIASES)
            ->setNamespaces(Generator::DEFAULT_NAMESPACES)
            ->generate($finder);

        return new JsonResponse($openapi);
    }
}
