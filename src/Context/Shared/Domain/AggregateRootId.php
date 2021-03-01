<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;


use Ramsey\Uuid\Uuid;

/**
 * @psalm-consistent-constructor
 */
abstract class AggregateRootId implements Id
{
    protected string $value;

    final protected function __construct(string $value = null)
    {
        if (null === $value) {
            $this->value = Uuid::uuid4()->toString();
        } elseif (Uuid::isValid($value)) {
            $this->value = $value;
        } else {
            throw new \LogicException(sprintf('Incorrect UUID string provided: "%s"', $value));
        }
    }

    /**
     * @return static
     */
    public static function create(): Id
    {
        return new static();
    }

    /**
     * @return static
     */
    public static function createFromString(string $value)
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}