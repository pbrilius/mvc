<?php

declare(strict_types=1);

namespace Prototype\Mvc\Presenter;

use Psr\Http\Message\ServerRequestInterface;

interface PresenterInterface
{
    public function prepareViewData(ServerRequestInterface $request): array;
}
