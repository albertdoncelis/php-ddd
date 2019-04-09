<?php


namespace AlbertDonCelis\DDD\Domain;

interface EventInterface
{
    public function eventId(): IDGenerator;

    public function eventName(): string;

    public function entityType(): string;

    public function entityId(): IDGenerator;

    public function timestamp(): int;
}
