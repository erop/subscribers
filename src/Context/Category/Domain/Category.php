<?php

declare(strict_types=1);

namespace App\Context\Category\Domain;


use App\Context\Category\Domain\Event\CategoryAdded;
use App\Context\Shared\Domain\AggregateRoot;

final class Category extends AggregateRoot implements \Serializable
{
    private string $name;

    public function __construct(string $name)
    {
        $this->id = CategoryId::create();
        $this->name = $name;
        $this->events[] = new CategoryAdded($this->id, $this->name);
    }

    public function fromData(array $data): void
    {
       $this->id = CategoryId::createFromString($data['id']);
       $this->name = $data['name'];
    }

    public function getState(): array
    {
        return [
            'id'   => $this->id->value(),
            'name' => $this->name,
        ];
    }

    public function serialize(): string
    {
        return json_encode($this->getState(), JSON_THROW_ON_ERROR);
    }

    public function unserialize($serialized): void
    {
        $data = json_decode($serialized, true, 512, JSON_THROW_ON_ERROR);
        $this->fromData($data);
    }
}