<?php

declare(strict_types=1);

namespace Prototype\Mvc;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Prototype\Mvc\View\ViewInterface;

interface ControllerInterface
{
    public function setView(ViewInterface $view): void;
}
