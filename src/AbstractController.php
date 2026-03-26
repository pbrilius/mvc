<?php

declare(strict_types=1);

namespace Prototype\Mvc;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Prototype\Mvc\View\ViewInterface;
use Prototype\Mvc\Presenter\PresenterInterface;

abstract class AbstractController implements ControllerInterface
{
    protected ViewInterface $view;
    protected PresenterInterface $presenter;

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function setPresenter(PresenterInterface $presenter): void
    {
        $this->presenter = $presenter;
    }

    abstract public function handle(ServerRequestInterface $request): ResponseInterface;

    protected function render(string $template, array $data = []): ResponseInterface
    {
        return $this->view->render($template, $data);
    }

    protected function json(mixed $data, int $statusCode = 200): ResponseInterface
    {
        return $this->view->json($data, $statusCode);
    }
}
