<?php

declare(strict_types=1);

namespace Prototype\Mvc\View;

use GuzzleHttp\Psr7\Response;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;

class PlatesView implements ViewInterface
{
    private Engine $engine;
    private ?string $layout = null;

    public function __construct(string $templatePath = '')
    {
        $this->engine = new Engine($templatePath ?: dirname(__DIR__, 2) . '/templates');
    }

    public function render(string $template, array $data = []): ResponseInterface
    {
        $content = $this->engine->render($template, $data);

        if ($this->layout !== null) {
            $content = $this->engine->render($this->layout, array_merge($data, ['content' => $content]));
        }

        return new Response(
            200,
            ['Content-Type' => 'text/html; charset=UTF-8'],
            $content
        );
    }

    public function json(mixed $data, int $statusCode = 200): ResponseInterface
    {
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return new Response(
            $statusCode,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            $json
        );
    }

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function getLayout(): ?string
    {
        return $this->layout;
    }
}
