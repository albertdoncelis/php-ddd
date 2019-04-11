<?php

namespace AlbertDonCelis\DDD\Example\Domain\ValueObject;

use Buttercup\Protects\IdentifiesAggregate;

class BasketId implements IdentifiesAggregate
{
    /** @var string $value */
    private $value;

    public function __construct(string $value)
    {
        $this->isValidUuid($value);

        $this->value = $value;
    }

    public static function generate(): IdentifiesAggregate
    {
        return new self(\Ramsey\Uuid\Uuid::uuid4()->toString());
    }

    /**
     * @param string $value
     */
    public function isValidUuid(string $value): void
    {
        if (!\Ramsey\Uuid\Uuid::isValid($value)) {
            throw new \InvalidArgumentException(
                sprintf(
                    '<%s> does not allow the value <%s>',
                    static::class,
                    is_scalar($value) ? $value : gettype($value)
                )
            );
        }
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function equals(IdentifiesAggregate $idGenerator): bool
    {
        return $this->__toString() === $idGenerator->__toString();
    }

    public static function fromString($idString): IdentifiesAggregate
    {
        return new self($idString);
    }
}
