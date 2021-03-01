<?php

declare(strict_types=1);

namespace App\Context\Category\Application\Command\Handler;


use App\Context\Category\Application\Command\AddCategory;
use App\Context\Category\Domain\Category;
use App\Context\Category\Domain\ICategoryRepository;

final class AddCategoryHandler
{
    private ICategoryRepository $repository;

    public function __construct(ICategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AddCategory $command): void
    {
        if (null !== $existing = $this->repository->findOneBy(['name' => $categoryName = $command->getName()])) {
            throw new \DomainException(sprintf('Category with name "%s" already exists', $categoryName));
        }
        $category = new Category($categoryName);
        $this->repository->save($category);
        // todo dispatch domain events
//        foreach ($category->releaseEvents() as $event) {
//            $this->dispatcher->dispatch($event);
//        }
    }


}