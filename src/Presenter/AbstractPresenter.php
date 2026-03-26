<?php

declare(strict_types=1);

namespace Prototype\Mvc\Presenter;

use Psr\Http\Message\ServerRequestInterface;
use Prototype\Mvc\Model\ModelInterface;

abstract class AbstractPresenter implements PresenterInterface
{
    protected ?ModelInterface $model = null;

    public function setModel(ModelInterface $model): void
    {
        $this->model = $model;
    }

    public function getModel(): ?ModelInterface
    {
        return $this->model;
    }

    abstract public function prepareViewData(ServerRequestInterface $request): array;
}
