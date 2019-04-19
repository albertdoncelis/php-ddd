<?php

namespace spec\AlbertDonCelis\DDD\Domain;

use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Domain\EventPublisherInterface;
use AlbertDonCelis\DDD\Infrastructure\Projection\ProjectionInterface;
use AlbertDonCelis\DDD\Domain\EventPublishers;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;
use PHPUnit\Framework\Assert;
use Prophecy\Argument;

/**
 * Class ProjectorSpec
 * @package spec\AlbertDonCelis\DDD\Infrastructure
 *
 * @mixin EventPublishers
 */
class EventPublishersSpec extends ObjectBehavior
{
    /**
     * @var Generator
     */
    private $faker;

    function it_is_initializable()
    {
        $this->shouldHaveType(EventPublishers::class);
    }

    public function let()
    {
        $this->faker = Factory::create();
    }

    public function it_should_register_subscribers(EventPublisherInterface $eventPublisher)
    {
        $eventPublishers = [];
        $randomCount = rand(1, 10);

        for ($count = 0; $randomCount > $count ; $count++) {

            $listenTo = $this->faker->userName;
            $eventPublisher->eventName()->shouldBeCalledTimes($randomCount)->willReturn($listenTo);
            $eventPublishers[$listenTo][] = $eventPublisher;
            $this->registerSubscriber($eventPublisher)->shouldReturn($this);
        }

        $registerProjections = $this->subscribers();
        $registerProjections->shouldReturn($eventPublishers);

    }

    public function it_should_notify_the_events(DomainEventInterface $event, EventPublisherInterface $eventPublish)
    {

        $eventPublishers = [];
        $randomCount = rand(1, 10);
        $listenToEvents = [];

        for ($count = 0; $randomCount > $count ; $count++) {
            $listenTo = $this->faker->userName;
            array_push($listenToEvents, $listenTo);
            $eventPublish->eventName()->shouldBeCalledTimes($randomCount)->willReturn($listenTo);
            $eventPublishers[$listenTo][] = $eventPublish;
            $this->registerSubscriber($eventPublish);
        }
        $event->eventName()->shouldBeCalledTimes(1)->willReturn($listenToEvents[$randomCount - 1]);
        $eventPublish->notify($event)->shouldBeCalledTimes(1);
        $this->notify($event);
    }
}
