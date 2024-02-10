<?php

namespace app\Repositories;

interface RepositoryInterface
{
    public function findAll(): array;

    public function find(int $id);

    public function save($entity): void;

    public function update($entity): void;

    public function delete(int $id): void;
}
