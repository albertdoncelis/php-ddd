<?php

namespace AlbertDonCelis\DDD\Domain;

use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\IsEventSourced;
use Buttercup\Protects\RecordsEvents;

abstract class AbstractEventSourced implements RecordsEvents
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
}
