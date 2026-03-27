<?php

declare(strict_types=1);

namespace Prototype\Mvc\Controller;

use Prototype\Mvc\AbstractController;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends AbstractController
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->index($request);
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $data = ['title' => 'Home', 'baseUrl' => (string) $request->getUri()];
        $this->view->setLayout('layout');

        return $this->render('home', $data);
    }

    public function about(ServerRequestInterface $request): ResponseInterface
    {
        $data = ['title' => 'About', 'baseUrl' => (string) $request->getUri()];
        $this->view->setLayout('layout');

        return $this->render('about', $data);
    }
}
