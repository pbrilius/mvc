<?php

declare(strict_types=1);

use Prototype\Mvc\Application;
use Prototype\Mvc\Http\RequestHandler;
use Prototype\Mvc\Middleware\CorsMiddleware;
use Prototype\Mvc\Middleware\JsonBodyParserMiddleware;
use Prototype\Mvc\Controller\HomeController;
use Prototype\Mvc\ServiceProvider;

require __DIR__ . "/../vendor/autoload.php";

$app = new Application();

ServiceProvider::register($app->getContainer());
$app->getContainer()->add(HomeController::class);

$app->addMiddleware(new CorsMiddleware());
$app->addMiddleware(new JsonBodyParserMiddleware());

$app->get("/", HomeController::class . "::index");
$app->get("/about", HomeController::class . "::about");

$request = RequestHandler::createFromGlobals();
$response = $app->getRouter()->handle($request);

RequestHandler::emit($response);
