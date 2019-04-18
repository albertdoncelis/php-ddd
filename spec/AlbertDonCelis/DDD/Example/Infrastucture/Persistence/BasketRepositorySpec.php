<?php

namespace spec\AlbertDonCelis\DDD\Example\Infrastucture\Persistence;

use AlbertDonCelis\DDD\Domain\AggregateRepositoryInterface;
use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Example\Domain\BasketWasPickedUp;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\BasketId;
use AlbertDonCelis\DDD\Example\Infrastucture\Persistence\BasketRepository;
use AlbertDonCelis\DDD\Infrastructure\EventStore\EventStoreInterface;
use AlbertDonCelis\DDD\Domain\EventPublisher;
use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\RecordsEvents;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class BasketRepositorySpec
 * @package spec\AlbertDonCelis\DDD\Example\Infrastucture\Persistence
 *
 * @mixin BasketRepository
 */
class BasketRepositorySpec extends ObjectBehavior
{
    /** @var EventStoreInterface $eventStore */
    private $eventStore;

    /** @var EventPublisher $projector */
    private $projector;

    /** @var Generator $faker */
    private $faker;

    function it_is_initializable()
    {
        $this->shouldHaveType(BasketRepository::class);
        $this->shouldHaveType(AggregateRepositoryInterface::class);
    }

    public function let(EventStoreInterface $eventStore, EventPublisher $projector)
    {

        $this->projector = $projector;
        $this->eventStore = $eventStore;
        $this->faker = Factory::create();

        $this->beConstructedWith($eventStore, $projector);
    }

    public function it_should_saved_events_in_event_store_and_projector(
        RecordsEvents $recordsEvents,
        DomainEvents $domainEvents)
    {
        $recordsEvents->getRecordedEvents()->shouldBeCalledTimes(1)->willReturn($domainEvents);
        $this->eventStore->commit($domainEvents)->shouldBeCalledTimes(1);
        $events = [];
        $basketId = new BasketId($this->faker->uuid);
        $events[] = new BasketWasPickedUp($basketId);

        $domainEvents->toArray()->shouldBeCalled()->willReturn($events);

        /** @var DomainEventInterface $event */
        foreach ($events as $event) {
            $this->projector->subscribeTo($event)->shouldBeCalledTimes(1);
        }

        $recordsEvents->clearRecordedEvents()->shouldBeCalledOnce();
        $this->save($recordsEvents);
    }
}
