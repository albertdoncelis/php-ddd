<?php

namespace AlbertDonCelis\DDD\Example\Infrastucture\Persistence;

use AlbertDonCelis\DDD\Domain\AggregateRepositoryInterface;
use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Infrastructure\EventStore\EventStoreInterface;
use AlbertDonCelis\DDD\Domain\EventPublishers;
use Buttercup\Protects\RecordsEvents;

class BasketRepository implements AggregateRepositoryInterface
{
    /**
     * @var EventPublishers
     */
    private $eventPublisher;

    /**
     * @var EventStoreInterface
     */
    private $eventStore;

    public function __construct(EventStoreInterface $eventStore, EventPublishers $eventPublisher)
    {
        $this->eventPublisher = $eventPublisher;
        $this->eventStore = $eventStore;
    }

    /**
     * @param RecordsEvents $recordEvents
     */
    public function save(RecordsEvents $recordEvents): void
    {
        $domainEvents = $recordEvents->getRecordedEvents();

        $this->eventStore->commit($domainEvents);

        /** @var DomainEventInterface $event */
        foreach ($domainEvents->toArray() as $event) {
            $this->eventPublisher->notify($event);
        }

        $recordEvents->clearRecordedEvents();
    }
}
