<?php

namespace Genxoft\SwaggerPhpModule\Test\Functional\Handler;

use Genxoft\SwaggerPhpModule\Test\Functional\AbstractFunctionalTest;
use Laminas\Diactoros\ServerRequest;

final class ApiDocsJsonTest extends AbstractFunctionalTest
{
    public function testJson(): void
    {
        $request = new ServerRequest([], [], '/api-oas-docs/json', 'GET');
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
