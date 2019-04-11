<?php

namespace spec\AlbertDonCelis\DDD\Infrastructure;

use AlbertDonCelis\DDD\Domain\EventInterface;
use AlbertDonCelis\DDD\Infrastructure\Projection\ProjectionInterface;
use AlbertDonCelis\DDD\Infrastructure\Projector;
use Faker\Factory;
use PhpSpec\ObjectBehavior;
use PHPUnit\Framework\Assert;
use Prophecy\Argument;

/**
 * Class ProjectorSpec
 * @package spec\AlbertDonCelis\DDD\Infrastructure
 *
 * @mixin Projector
 */
class ProjectorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Projector::class);
    }

    /**
     * @param ProjectionInterface $projection
     */
    public function it_should_register_projection(ProjectionInterface $projection)
    {
        $projections = [];
        $randomCount = rand(1, 10);

        for ($count = 0; $randomCount > $count ; $count++) {

            $listenTo = Factory::create()->userName();
            $projection->listenToEventNameOf()->shouldBeCalledTimes($randomCount)->willReturn($listenTo);
            $projections[$listenTo][] = $projection;
            $this->register($projection)->shouldReturn($this);
        }

        $registerProjections = $this->registeredProjections();
        $registerProjections->shouldReturn($projections);

    }

    public function it_should_subscribe(EventInterface $event, ProjectionInterface $projection) {

        $projections = [];
        $randomCount = rand(1, 10);
        $listenToEvents = [];

        for ($count = 0; $randomCount > $count ; $count++) {
            $listenTo = Factory::create()->userName();
            array_push($listenToEvents, $listenTo);
            $projection->listenToEventNameOf()->shouldBeCalledTimes($randomCount)->willReturn($listenTo);
            $projections[$listenTo][] = $projection;
            $this->register($projection);
        }
        $event->eventName()->shouldBeCalledTimes(1)->willReturn($listenToEvents[$randomCount - 1]);
        $projection->project($event)->shouldBeCalledTimes(1);
        $this->subscribeTo($event);
    }


}
