<?php

declare(strict_types=1);

namespace App\Context\Category\Domain;


interface ICategoryRepository
{
    public function save(Category $category): void;

    /**
     * @return array|Category[]
     */
    public function findAll(): array;

    public function find(CategoryId $id): ?Category;

    public function findBy(array $criteria): array;

    public function findOneBy(array $criteria): ?Category;
}