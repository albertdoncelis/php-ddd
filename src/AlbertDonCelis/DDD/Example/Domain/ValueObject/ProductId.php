<?php

namespace AlbertDonCelis\DDD\Example\Domain\ValueObject;

use Buttercup\Protects\IdentifiesAggregate;

class ProductId implements IdentifiesAggregate
{
    use IdentifiesAggregateTraits;

    /** @var string $value */
    private $value;

    public function __construct(string $value)
    {
        $this->isValidUuid($value);

        $this->value = $value;
    }
}
