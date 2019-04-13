<?php

namespace AlbertDonCelis\DDD\Domain;

use Buttercup\Protects\CorruptAggregateHistory;
use Buttercup\Protects\DomainEvent;
use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\IdentifiesAggregate;

class History extends DomainEvents
{

    /** @var IdentifiesAggregate $aggregateId */
    private $aggregateId;

    public function __construct(IdentifiesAggregate $aggregateId, array $events)
    {
        /** @var DomainEvent $event */
        foreach ($events as $event) {
            if (!$event->getAggregateId()->equals($aggregateId)) {
                throw new CorruptAggregateHistory();
            }
        }
        parent::__construct($events);

        $this->aggregateId = $aggregateId;
    }

    public function aggregateId()
    {
        return $this->aggregateId;
    }
}
