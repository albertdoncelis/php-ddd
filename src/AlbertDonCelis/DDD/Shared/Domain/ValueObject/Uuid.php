<?php

namespace AlbertDonCelis\DDD\Shared\Domain\ValueObject;

class Uuid
{
    /** @var string $value */
    private $value;

    public function __construct(string $value)
    {
        $this->isValidUuid($value);
        $this->value = $value;
    }

    public static function generate(): self
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
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
