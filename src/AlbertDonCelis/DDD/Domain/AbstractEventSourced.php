<?php

namespace AlbertDonCelis\DDD\Domain;

use Buttercup\Protects\DomainEvent;
use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\RecordsEvents;

abstract class AbstractEventSourced implements RecordsEvents, EventSourcedInterface
{
    /**
     * @var DomainEvents []
     */
    protected $recordEvents = [];

    public function clearRecordedEvents()
    {
        $this->recordEvents = [];
    }

    /**
     * @return DomainEvents
     */
    public function getRecordedEvents(): DomainEvents
    {
        return new DomainEvents($this->recordEvents);
    }

    /**
     * @param DomainEvent $domain
     */
    public function recordThat(DomainEvent $domain): void
    {
        $this->recordEvents[] = $domain;
    }
}
