<?php

declare(strict_types=1);

namespace Prototype\Mvc\View;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
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

        return new HtmlResponse($content);
    }

    public function json(mixed $data, int $statusCode = 200): ResponseInterface
    {
        return new JsonResponse($data, $statusCode);
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
