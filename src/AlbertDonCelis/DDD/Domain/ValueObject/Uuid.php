<?php

namespace AlbertDonCelis\DDD\Domain\ValueObject;

use AlbertDonCelis\DDD\Domain\IDGenerator;

class Uuid implements IDGenerator
{
    /** @var string $value */
    private $value;

    public function __construct(string $value)
    {
        $this->isValidUuid($value);

        $this->value = $value;
    }

    public static function generate(): IDGenerator
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

    public function value(): string
    {
        return (string) $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

    public function equals(IDGenerator $idGenerator): bool
    {
        return $this->value() === $idGenerator->value();
    }
}
