<?php

namespace AlbertDonCelis\DDD\Example\Domain;

use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\BasketId;
use Buttercup\Protects\IdentifiesAggregate;

class BasketWasPickedUp implements DomainEventInterface
{
    /** @var BasketId $basketId */
    private $basketId;

    public function __construct(BasketId $basketId)
    {
        $this->basketId = $basketId;
    }

    /**
     * The Aggregate this event belongs to.
     * @return IdentifiesAggregate
     */
    public function getAggregateId(): IdentifiesAggregate
    {
        return $this->basketId;
    }

    public function eventName(): string
    {
        return "BasketWasPickedUp";
    }

    public function entityType(): string
    {
        return "Basket";
    }

    public function data(): array
    {
        return [];
    }
}
