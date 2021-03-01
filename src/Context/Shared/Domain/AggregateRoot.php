<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;


abstract class AggregateRoot
{
    protected Id $id;

    protected array $events = [];

    public function record(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }

    public function id(): Id
    {
        return $this->id;
    }

}