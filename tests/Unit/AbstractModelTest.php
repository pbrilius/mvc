<?php

declare(strict_types=1);

namespace Prototype\Mvc\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Prototype\Mvc\Model\AbstractModel;

class TestModel extends AbstractModel
{
}

class AbstractModelTest extends TestCase
{
    private TestModel $model;

    protected function setUp(): void
    {
        $this->model = new TestModel();
    }

    public function testCreateReturnsDataWithId(): void
    {
        $data = ['name' => 'Test'];
        $result = $this->model->create($data);

        $this->assertArrayHasKey('id', $result);
        $this->assertEquals('Test', $result['name']);
    }

    public function testFindByIdReturnsNullWhenNotFound(): void
    {
        $result = $this->model->findById('nonexistent');
        $this->assertNull($result);
    }

    public function testFindByIdReturnsData(): void
    {
        $created = $this->model->create(['name' => 'FindMe']);
        $result = $this->model->findById($created['id']);

        $this->assertEquals('FindMe', $result['name']);
    }

    public function testFindAllReturnsAllRecords(): void
    {
        $this->model->create(['name' => 'One']);
        $this->model->create(['name' => 'Two']);

        $results = $this->model->findAll();
        $this->assertCount(2, $results);
    }

    public function testUpdateReturnsUpdatedData(): void
    {
        $created = $this->model->create(['name' => 'Original']);
        $result = $this->model->update($created['id'], ['name' => 'Updated']);

        $this->assertEquals('Updated', $result['name']);
    }

    public function testDeleteReturnsTrueWhenDeleted(): void
    {
        $created = $this->model->create(['name' => 'ToDelete']);
        $result = $this->model->delete($created['id']);

        $this->assertTrue($result);
        $this->assertNull($this->model->findById($created['id']));
    }
}
