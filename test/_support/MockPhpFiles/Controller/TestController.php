<?php

declare(strict_types=1);

namespace Genxoft\SwaggerPhpModule\Test\_support\MockPhpFiles\Controller;

/**
 * @OA\Info(title="Test API", version="0.1")
 */
final class TestController
{
    /**
     * @OA\Get(
     *   path="/ping",
     *   operationId="test.index",
     *   @OA\Parameter(
     *     name="s",
     *     in="query",
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="An example resource",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="object",
     *         ref="#/components/schemas/TestModel",
     *       ),
     *     ),
     *   )
     * )
     */
    public function testAction(): void
    {
    }
}
