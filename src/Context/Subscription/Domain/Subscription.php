<?php

declare(strict_types=1);

namespace App\Context\Subscription\Domain;


use App\Context\Category\Domain\CategoryId;

final class Subscription
{
    private string $name;

    private string $email;

    /**
     * @var array|CategoryId[]
     */
    private array $categoryIds;

    public function __construct(string $name, string $email, array $categoryIds)
    {
        $this->name = $name;
        $this->email = $email;
        $this->categoryIds = $categoryIds;
    }


}