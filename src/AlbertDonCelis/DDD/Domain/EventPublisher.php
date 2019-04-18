<?php

namespace AlbertDonCelis\DDD\Domain;

class EventPublisher
{
    private $projections = [];

    public function register(EventPublishInterface $eventPublish): self
    {
        $this->projections[$eventPublish->listenToEventNameOf()][] = $eventPublish;

        return $this;
    }

    public function subscribers(): array
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

            /** @var EventPublishInterface $eventPublish */
            foreach ($this->projections[$eventListenTo] as $eventPublish) {
                $eventPublish->publish($event);
            }
        }
    }
}
