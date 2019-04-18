<?php

namespace spec\AlbertDonCelis\DDD\Domain;

use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Domain\EventPublishInterface;
use AlbertDonCelis\DDD\Infrastructure\Projection\ProjectionInterface;
use AlbertDonCelis\DDD\Domain\EventPublisher;
use Faker\Factory;
use PhpSpec\ObjectBehavior;
use PHPUnit\Framework\Assert;
use Prophecy\Argument;

/**
 * Class ProjectorSpec
 * @package spec\AlbertDonCelis\DDD\Infrastructure
 *
 * @mixin EventPublisher
 */
class EventPublisherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EventPublisher::class);
    }

    /**
     * @param ProjectionInterface $eventPublish
     */
    public function it_should_register_subscribers(EventPublishInterface $eventPublish)
    {
        $projections = [];
        $randomCount = rand(1, 10);

        for ($count = 0; $randomCount > $count ; $count++) {

            $listenTo = Factory::create()->userName();
            $eventPublish->listenToEventNameOf()->shouldBeCalledTimes($randomCount)->willReturn($listenTo);
            $projections[$listenTo][] = $eventPublish;
            $this->register($eventPublish)->shouldReturn($this);
        }

        $registerProjections = $this->subscribers();
        $registerProjections->shouldReturn($projections);

    }

    public function it_should_subscribe_to(DomainEventInterface $event, EventPublishInterface $eventPublish) {

        $projections = [];
        $randomCount = rand(1, 10);
        $listenToEvents = [];

        for ($count = 0; $randomCount > $count ; $count++) {
            $listenTo = Factory::create()->userName();
            array_push($listenToEvents, $listenTo);
            $eventPublish->listenToEventNameOf()->shouldBeCalledTimes($randomCount)->willReturn($listenTo);
            $projections[$listenTo][] = $eventPublish;
            $this->register($eventPublish);
        }
        $event->eventName()->shouldBeCalledTimes(1)->willReturn($listenToEvents[$randomCount - 1]);
        $eventPublish->publish($event)->shouldBeCalledTimes(1);
        $this->subscribeTo($event);
    }


}
