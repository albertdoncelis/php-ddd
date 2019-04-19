<?php

namespace AlbertDonCelis\DDD\Domain;

class EventPublishers
{
    private $subscribersByEvent = [];

    public function registerSubscriber(EventPublisherInterface $eventPublish): self
    {
        $this->subscribersByEvent[$eventPublish->eventName()][] = $eventPublish;

        return $this;
    }

    public function subscribers(): array
    {
        return $this->subscribersByEvent;
    }

    private function hasSubscriber(string $listenToEventNameOf): bool
    {
        return array_key_exists($listenToEventNameOf, $this->subscribersByEvent);
    }

    public function notify(DomainEventInterface $event)
    {
        $eventListenTo = $event->eventName();

        if ($this->hasSubscriber($eventListenTo)) {

            /** @var EventPublisherInterface $eventPublisher */
            foreach ($this->subscribersByEvent[$eventListenTo] as $eventPublisher) {
                $eventPublisher->notify($event);
            }
        }
    }
}
