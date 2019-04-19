<?php


namespace AlbertDonCelis\DDD\Domain;

interface EventPublisherInterface
{
    public function eventName(): string;

    public function notify(DomainEventInterface $domainEvent): void;
}
