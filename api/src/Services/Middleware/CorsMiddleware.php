<?php

namespace App\Services\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CorsMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Request-Method: GET, POST, PUT');
        header('Access-Control-Allow-Headers: X-Custom-Header');

        return $handler->handle($request);
    }
}
