<?php

namespace AlbertDonCelis\DDD\Example\Domain;

use AlbertDonCelis\DDD\Domain\AbstractEventSourced;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\BasketId;

class BasketEventSourced extends AbstractEventSourced
{
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
}
