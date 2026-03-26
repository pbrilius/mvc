<?php

declare(strict_types=1);

namespace Prototype\Mvc\Model;

interface ModelInterface
{
    public function findById(int|string $id): ?array;
    public function findAll(): array;
    public function create(array $data): array;
    public function update(int|string $id, array $data): ?array;
    public function delete(int|string $id): bool;
}
