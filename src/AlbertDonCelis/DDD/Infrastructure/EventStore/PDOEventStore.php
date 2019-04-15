<?php

namespace AlbertDonCelis\DDD\Infrastructure\EventStore;

use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Domain\History;
use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\IdentifiesAggregate;

class PDOEventStore implements EventStoreInterface
{
    /** @var \PDO $pdo */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function eventStoreInsertString(): string
    {
        return <<<EOF
INSERT INTO events (aggregate_id, `event_name`, `entity_type`, created_at, `data`) VALUES (:aggregate_id, :event_name, :entity_type, :created_at, :data)
EOF;
    }
    public function commit(DomainEvents $domainEvents): void
    {
        $stmt = $this->pdo->prepare($this->eventStoreInsertString());

        /** @var DomainEventInterface $event */
        foreach ($domainEvents as $event) {
            $stmt->execute([
                ':aggregate_id' => (string) $event->getAggregateId(),
                ':event_name' => $event->eventName(),
                ':entity_type' => $event->entityType(),
                ':created_at' => date('Y-m-d H:i:s'),
                ':data' => json_encode($event->data())
            ]);
        }
    }
}
