<?php

declare(strict_types=1);

namespace Prototype\Mvc\Model;

abstract class AbstractModel implements ModelInterface
{
    protected array $storage = [];
    protected int $lastId = 0;

    public function findById(int|string $id): ?array
    {
        return $this->storage[(string) $id] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->storage);
    }

    public function create(array $data): array
    {
        $this->lastId++;
        $id = (string) $this->lastId;
        $data['id'] = $id;
        $this->storage[$id] = $data;
        return $data;
    }

    public function update(int|string $id, array $data): ?array
    {
        if (!isset($this->storage[(string) $id])) {
            return null;
        }
        $this->storage[(string) $id] = array_merge($this->storage[(string) $id], $data);
        return $this->storage[(string) $id];
    }

    public function delete(int|string $id): bool
    {
        if (!isset($this->storage[(string) $id])) {
            return false;
        }
        unset($this->storage[(string) $id]);
        return true;
    }
}
