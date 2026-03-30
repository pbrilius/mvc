<?php

declare(strict_types=1);

namespace Prototype\Mvc\Http;

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestHandler
{
    public static function createFromGlobals(): ServerRequestInterface
    {
        return ServerRequest::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );
    }

    public static function emit(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();
        $reasonPhrase = $response->getReasonPhrase();

        http_response_code($statusCode);

        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        $body = $response->getBody();
        $body->rewind();

        while (!$body->eof()) {
            echo $body->read(8192);
        }
    }
}
