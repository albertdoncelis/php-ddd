<?php

namespace AlbertDonCelis\DDD\Example\Infrastucture\Persistence;

use AlbertDonCelis\DDD\Domain\AggregateRepositoryInterface;
use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Infrastructure\EventStore\EventStoreInterface;
use AlbertDonCelis\DDD\Infrastructure\Projector;
use Buttercup\Protects\RecordsEvents;

class BasketRepository implements AggregateRepositoryInterface
{
    /**
     * @var Projector
     */
    private $projector;

    /**
     * @var EventStoreInterface
     */
    private $eventStore;

    public function __construct(EventStoreInterface $eventStore, Projector $projector)
    {
        $this->projector = $projector;
        $this->eventStore = $eventStore;
    }

    /**
     * @param RecordsEvents $recordEvents
     */
    public function saveEventSourced(RecordsEvents $recordEvents): void
    {
        $domainEvents = $recordEvents->getRecordedEvents();

        $this->eventStore->commit($domainEvents);

        /** @var DomainEventInterface $event */
        foreach ($domainEvents->toArray() as $event) {
            $this->projector->subscribeTo($event);
        }

        $recordEvents->clearRecordedEvents();
    }
}
