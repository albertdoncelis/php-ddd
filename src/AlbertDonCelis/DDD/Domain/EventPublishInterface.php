<?php


namespace AlbertDonCelis\DDD\Domain;


interface EventPublishInterface
{
    public function listenToEventNameOf(): string;

    public function publish(DomainEventInterface $domainEvent): void;
}