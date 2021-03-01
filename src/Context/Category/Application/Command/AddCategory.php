<?php

declare(strict_types=1);

namespace App\Context\Category\Application\Command;


final class AddCategory
{
    private string $name;

    public function __construct(string $categoryName)
    {
        $this->name = $categoryName;
    }

    public function getName(): string
    {
        return $this->name;
    }


}