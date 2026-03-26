<?php

declare(strict_types=1);

namespace Prototype\Mvc;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Prototype\Mvc\View\ViewInterface;
use Prototype\Mvc\Presenter\PresenterInterface;

interface ControllerInterface
{
    public function setView(ViewInterface $view): void;
    public function setPresenter(PresenterInterface $presenter): void;
    public function handle(ServerRequestInterface $request): ResponseInterface;
}
