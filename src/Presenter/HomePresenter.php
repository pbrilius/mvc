<?php

declare(strict_types=1);

namespace Prototype\Mvc\Presenter;

use Psr\Http\Message\ServerRequestInterface;

class HomePresenter extends AbstractPresenter
{
    public function prepareViewData(ServerRequestInterface $request): array
    {
        return [
            'title' => 'Prototype MVC',
            'baseUrl' => (string) $request->getUri(),
        ];
    }
}
