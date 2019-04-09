<?php


namespace AlbertDonCelis\DDD\Domain;

interface IDGenerator
{
    /**
     * @return IDGenerator
     */
    public static function generate(): self;

    /**
     * @return string
     */
    public function value(): string;
}
