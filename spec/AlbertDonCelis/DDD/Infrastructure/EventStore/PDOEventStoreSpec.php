<?php

namespace spec\AlbertDonCelis\DDD\Infrastructure\EventStore;

require_once 'GlobalFunction.php';

use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Example\Domain\BasketEventSourced;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\BasketId;
use AlbertDonCelis\DDD\Infrastructure\EventStore\EventStoreInterface;
use AlbertDonCelis\DDD\Infrastructure\EventStore\PDOEventStore;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;
/**
 * Class PDOEventStoreSpec
 * @package spec\AlbertDonCelis\DDD\Infrastructure\EventStore
 *
 * @mixin PDOEventStore
 */
class PDOEventStoreSpec extends ObjectBehavior
{
    /** @var \PDO $pdo */
    private $pdo;

    /** @var Generator $faker */
    private $faker;

    function it_is_initializable()
    {
        $this->shouldHaveType(PDOEventStore::class);
        $this->shouldHaveType(EventStoreInterface::class);
    }

    public function let(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->faker = Factory::create();
        $this->beConstructedWith($pdo);
    }

    private function insertDataString(): string
    {
        return <<<EOF
INSERT INTO events (aggregate_id, `event_name`, `entity_type`, created_at, `data`) VALUES (:aggregate_id, :event_name, :entity_type, :created_at, :data)
EOF;

    }

    public function it_should_insert_data_of_a_domain_events(\PDOStatement $statement)
    {
        $this->pdo->prepare($this->insertDataString())->shouldBeCalledTimes(1)->willReturn($statement);

        $basketId = new BasketId($this->faker->uuid);

        $basketEventSourced = BasketEventSourced::pickUp($basketId);

        $recordEvents = $basketEventSourced->getRecordedEvents();

        /** @var DomainEventInterface $event */
        foreach($recordEvents as $event) {

            $statement->execute([
                ':aggregate_id' => (string) $basketId,
                ':event_name' => $event->eventName(),
                ':entity_type' => $event->entityType(),
                ':created_at' => date('Y-m-d H:i:s'),
                ':data' => json_encode($event->data())

            ])->shouldBeCalledTimes(count($recordEvents));

        }

        $this->commit($recordEvents);

    }
}

function date($format) {
    return $format;
}