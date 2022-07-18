<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Test\Unit\Handler;

use Genxoft\SwaggerPhpModule\Handler\JsonAction;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class JsonActionTest extends TestCase
{
    public function testHandle(): void
    {
        $jsonAction = new JsonAction([
            realpath(__DIR__.'/../../_support/MockPhpFiles/Controller'),
            realpath(__DIR__.'/../../_support/MockPhpFiles/Model'),
        ]);

        /** @var JsonResponse $response */
        $response = $jsonAction->handle(new ServerRequest());
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('application/json', $response->getHeader('Content-type')[0]);
        self::assertJson($response->getBody()->getContents());
        $payload = $response->getPayload();

        self::assertObjectHasAttribute('openapi', $payload);
        self::assertObjectHasAttribute('info', $payload);
        self::assertObjectHasAttribute('paths', $payload);
        self::assertObjectHasAttribute('components', $payload);
    }
}
