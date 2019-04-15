<?php


namespace AlbertDonCelis\DDD\Domain;

use Buttercup\Protects\DomainEvent;

interface DomainEventInterface extends DomainEvent
{
    public function eventName(): string;

    public function entityType(): string;

    public function data(): array;
}
