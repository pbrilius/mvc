<?php

declare(strict_types=1);

namespace Prototype\Mvc;

use League\Container\Container;

class ServiceProvider
{
    public static function register(Container $container): void
    {
        $container->add(View\ViewInterface::class, View\PlatesView::class);

        $container->inflector(ControllerInterface::class)
            ->invokeMethod('setView', [View\ViewInterface::class]);
    }
}
