<?php

declare(strict_types=1);

namespace Prototype\Mvc;

use League\Container\Container;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Server\MiddlewareInterface;

class Application
{
    private Container $container;
    private Router $router;

    public function __construct(?Container $container = null)
    {
        $this->container = $container ?? new Container();
        $this->router = new Router();
        $this->configureRouter();
    }

    private function configureRouter(): void
    {
        $strategy = new ApplicationStrategy();
        $strategy->setContainer($this->container);
        $this->router->setStrategy($strategy);
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->router->middleware($middleware);
    }

    public function register(string $id, object $instance): void
    {
        $this->container->add($id, $instance);
    }

    public function registerFactory(string $id, callable $factory): void
    {
        $this->container->add($id, $factory);
    }

    public function map(string $method, string $path, callable|string $handler): void
    {
        $this->router->map($method, $path, $handler);
    }

    public function get(string $path, callable|string $handler): void
    {
        $this->router->get($path, $handler);
    }

    public function post(string $path, callable|string $handler): void
    {
        $this->router->post($path, $handler);
    }

    public function put(string $path, callable|string $handler): void
    {
        $this->router->put($path, $handler);
    }

    public function delete(string $path, callable|string $handler): void
    {
        $this->router->delete($path, $handler);
    }

    public function patch(string $path, callable|string $handler): void
    {
        $this->router->patch($path, $handler);
    }
}
