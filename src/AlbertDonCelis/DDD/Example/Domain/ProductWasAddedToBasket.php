<?php

namespace AlbertDonCelis\DDD\Example\Domain;

use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\BasketId;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\ProductId;
use Buttercup\Protects\IdentifiesAggregate;

class ProductWasAddedToBasket implements DomainEventInterface
{
    /** @var BasketId $basketId */
    private $basketId;

    /** @var ProductId $productId */
    private $productId;

    /** @var string $productName */
    private $productName;

    public function __construct(BasketId $basketId, ProductId $productId, string $productName)
    {
        $this->basketId = $basketId;
        $this->productId = $productId;
        $this->productName = $productName;
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
        return "ProductWasAddedToBasket";
    }

    public function entityType(): string
    {
        return "Basket";
    }

    public function productName(): string
    {
        return $this->productName;
    }

    public function productId(): IdentifiesAggregate
    {
        return $this->productId;
    }

    public function data(): array
    {
        return [];
    }
}
