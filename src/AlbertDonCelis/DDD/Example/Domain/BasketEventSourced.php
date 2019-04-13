<?php

namespace AlbertDonCelis\DDD\Example\Domain;

use AlbertDonCelis\DDD\Domain\AbstractEventSourced;
use AlbertDonCelis\DDD\Domain\ApplyThatTraits;
use AlbertDonCelis\DDD\Domain\History;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\BasketId;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\ProductId;
use Buttercup\Protects\DomainEvent;

/**
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod);
 * @SuppressWarnings(PHPMD.UnusedFormalParameter);
 *
 */
class BasketEventSourced extends AbstractEventSourced
{
    use ApplyThatTraits;

    /** @var BasketId $basketId */
    private $basketId;

    private function __construct(BasketId $basketId)
    {
        $this->basketId = $basketId;
    }

    /**
     * @param BasketId $basketId
     * @return BasketEventSourced
     */
    public static function pickUp(BasketId $basketId): self
    {
        $basket = new self($basketId);

        $basket->recordThat(
            new BasketWasPickedUp($basketId)
        );

        return $basket;
    }

    public function addProduct(ProductId $productId, string $productName): void
    {
        $this->recordThat(
            new ProductWasAddedToBasket($this->basketId, $productId, $productName)
        );
    }

    public static function reconstituteFrom(History $aggregateHistory)
    {
        $basketId = $aggregateHistory->aggregateId();
        $basketEventSourced = new self(new BasketId($basketId));

        foreach ($aggregateHistory as $event) {
            $basketEventSourced->applyThat($event);
        }

        return $basketEventSourced;
    }

    private function applyThatBasketWasPickedUp(DomainEvent $domainEvent)
    {
    }
}
