<?php

declare(strict_types=1);

namespace Prototype\Mvc\View;

use Psr\Http\Message\ResponseInterface;

interface ViewInterface
{
    public function render(string $template, array $data = []): ResponseInterface;
    public function json(mixed $data, int $statusCode = 200): ResponseInterface;
    public function setLayout(string $layout): void;
    public function getLayout(): ?string;
}
