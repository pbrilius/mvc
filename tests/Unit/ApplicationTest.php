<?php

declare(strict_types=1);

namespace Prototype\Mvc\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Prototype\Mvc\Application;
use League\Container\Container;
use League\Route\Router;

class ApplicationTest extends TestCase
{
    private Application $app;

    protected function setUp(): void
    {
        $this->app = new Application();
    }

    public function testGetContainerReturnsContainer(): void
    {
        $container = $this->app->getContainer();
        $this->assertInstanceOf(Container::class, $container);
    }

    public function testRegisterAddsServiceToContainer(): void
    {
        $service = new class {
            public function test(): string
            {
                return 'test';
            }
        };

        $this->app->register('test.service', $service);

        $resolved = $this->app->getContainer()->get('test.service');
        $this->assertSame($service, $resolved);
    }

    public function testMapAddsRoute(): void
    {
        $this->app->map('GET', '/test', fn() => 'ok');
        $this->assertInstanceOf(Router::class, $this->app->getRouter());
    }

    public function testGetShortcutAddsRoute(): void
    {
        $this->app->get('/hello', fn() => 'world');
        $this->assertInstanceOf(Router::class, $this->app->getRouter());
    }

    public function testPostShortcutAddsRoute(): void
    {
        $this->app->post('/create', fn() => 'created');
        $this->assertInstanceOf(Router::class, $this->app->getRouter());
    }
}
