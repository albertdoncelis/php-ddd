<?php

namespace AlbertDonCelis\DDD\Infrastructure;

use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Infrastructure\Projection\ProjectionInterface;

class Projector
{
    private $projections = [];

    public function register(ProjectionInterface $projection): self
    {
        $this->projections[$projection->listenToEventNameOf()][] = $projection;

        return $this;
    }

    public function registeredProjections(): array
    {
        return $this->projections;
    }

    private function hasSubscriber(string $listenToEventNameOf): bool
    {
        return array_key_exists($listenToEventNameOf, $this->projections);
    }

    public function subscribeTo(DomainEventInterface $event)
    {
        $eventListenTo = $event->eventName();

        if ($this->hasSubscriber($eventListenTo)) {

            /** @var ProjectionInterface $projection */
            foreach ($this->projections[$eventListenTo] as $projection) {
                $projection->project($event);
            }
        }
    }
}
