<?php

declare(strict_types=1);

namespace App\Context\Category\Domain\Event;


use App\Context\Category\Domain\CategoryId;

final class CategoryAdded extends \DomainException
{
    private CategoryId $id;

    private string $name;

    public function __construct(CategoryId $id, string $name)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}