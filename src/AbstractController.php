<?php

declare(strict_types=1);

namespace Prototype\Mvc;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Prototype\Mvc\View\ViewInterface;

class AbstractController implements ControllerInterface
{
    protected ViewInterface $view;

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    protected function render(string $template, array $data = []): ResponseInterface
    {
        return $this->view->render($template, $data);
    }

    protected function json(mixed $data, int $statusCode = 200): ResponseInterface
    {
        return $this->view->json($data, $statusCode);
    }
}
