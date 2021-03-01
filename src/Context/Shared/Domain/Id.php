<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;


interface Id
{
    public function value(): string;
}