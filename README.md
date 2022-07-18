# Swagger PHP module

## Description

Swagger PHP module adapted for Mezzio/Laminas.

## Requirements

- PHP >7.4
- Mezzio\Template\TemplateRendererInterface

## Installation


The preferred way to install this wrapper is through [composer](http://getcomposer.org/download/).

```bash
php composer.phar require genxoft/php-swagger-module
```

or

```bash
composer require genxoft/php-swagger-module
```

or add to the require section of `composer.json`

```
"genxoft/php-swagger-module" : "*"
```

## Setup

After installation of the package, you need to complete the following steps to use PHP Swagger module:

1. Add ```\Genxoft\SwaggerPhpModule\ConfigProvider::class``` to your config aggregator
2. Add and customize (if necessary) configuration (add file ```php-swagger.global.php``` into ```config/autoload```)
```php
<?php
return [
    'swagger_php' => [
        'scanDirs' => [
            __DIR__ . '/module'
        ],
        'jsonUrl' => '/api-oas-docs/json',
    ],
    'routes' => [
        'swagger_php.route.json' => [
            'path' => '/api-oas-docs/json',
            'middleware' => [
                \Genxoft\SwaggerPhpModule\Handler\JsonAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        'swagger_php.route.ui' => [
            'path' => '/api-oas-docs/ui',
            'middleware' => [
                \Genxoft\SwaggerPhpModule\Handler\UiAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
    ],
];
```

## Open Api Swagger 3 example annotation

Api server description

```php
/**
 * @OA\Info(
 *   version="1.0",
 *   title="Application API",
 *   description="Server - Mobile app API",
 *   @OA\Contact(
 *     name="John Smith",
 *     email="john@example.com",
 *   ),
 * ),
 * @OA\Server(
 *   url="https://example.com/api",
 *   description="main server",
 * )
 * @OA\Server(
 *   url="https://dev.example.com/api",
 *   description="dev server",
 * )
 */
...
 ```

Handler annotation

```php
/**
 * @OA\Get(path="/",
 *   summary="Handshake",
 *   tags={"handshake"},
 *   @OA\Parameter(
 *     name="access-token",
 *     in="header",
 *     required=false,
 *     @OA\Schema(
 *       type="string"
 *     )
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns Hello object",
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(ref="#/components/schemas/Hello"),
 *     ),
 *   ),
 * )
 */
class HelloHandler implements RequestHandlerInterface
{
...
```
Model annotation
```php
/**
 *@OA\Schema(
 *  schema="Hello",
 *  @OA\Property(
 *     property="message",
 *     type="string",
 *     description="Text message"
 *  ),
 *  @OA\Property(
 *     property="time",
 *     type="integer",
 *     description="Server current Unix time"
 *  ),
 *  @OA\Property(
 *     property="date",
 *     type="string",
 *     format="date-time",
 *     description="Server current date time"
 *  )
 *)
 */
class HelloModel
{
...
```

## Screenshot

![Swagger UI Screenshot](/docs/swagger-ui-screenshot.png)

## Donate
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2PURUX2SHUD9E"><img src="https://www.paypalobjects.com/en_US/RU/i/btn/btn_donateCC_LG.gif"></a>

## LICENSE
This curl wrapper is released under the [MIT license](/LICENSE.md).
