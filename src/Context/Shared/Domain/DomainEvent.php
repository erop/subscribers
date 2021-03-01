<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;


abstract class DomainEvent implements Event
{
    protected \DateTimeImmutable $occurredAt;

    public function __construct(\DateTimeImmutable $occurredAt)
    {
        $this->occurredAt = $occurredAt;
    }

    public function occurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }
}