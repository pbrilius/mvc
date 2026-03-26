<?php

declare(strict_types=1);

namespace Prototype\Mvc;

use League\Container\Container;

class ServiceProvider
{
    public static function register(Container $container): void
    {
        $container->add(View\ViewInterface::class, View\PlatesView::class);
        $container->add(Presenter\PresenterInterface::class, Presenter\HomePresenter::class);

        $container->inflector(ControllerInterface::class)
            ->invokeMethod('setView', [View\ViewInterface::class])
            ->invokeMethod('setPresenter', [Presenter\PresenterInterface::class]);
    }
}
