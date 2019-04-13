<?php

namespace spec\AlbertDonCelis\DDD\Domain;

use AlbertDonCelis\DDD\Domain\History;
use Buttercup\Protects\CorruptAggregateHistory;
use Buttercup\Protects\DomainEvent;
use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\IdentifiesAggregate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class HistorySpec
 * @package spec\AlbertDonCelis\DDD\Domain
 *
 * @mixin History
 */
class HistorySpec extends ObjectBehavior
{
    /** @var IdentifiesAggregate $aggregateId */
    private $aggregateId;

    function it_is_initializable()
    {
        $this->shouldHaveType(History::class);
        $this->shouldHaveType(DomainEvents::class);
    }

    public function let(IdentifiesAggregate $aggregate)
    {
        $this->aggregateId = $aggregate;

        $this->beConstructedWith($aggregate, []);
    }

    public function it_should_throw_exception_CorruptAggregateHistory(
        IdentifiesAggregate $aggregateId, DomainEvent $event)
    {

        $events = [];
        $randomEvent = rand(1,5);
        for ($countEvent = 0; $randomEvent > $countEvent; $countEvent++) {
            $event->getAggregateId()->shouldBeCalled($randomEvent)->willReturn($aggregateId);
            $aggregateId->equals($aggregateId)->shouldBeCalled($randomEvent)->willReturn(false);
            array_push($events, $event);
        }
        $this->shouldThrow(CorruptAggregateHistory::class)
            ->during__construct($aggregateId, $events);
    }

    public function it_should_not_throw_exception_CorruptAggregateHistory(
        IdentifiesAggregate $aggregateId,
        DomainEvent $event)
    {
        $events = [];
        $randomEvent = rand(1,5);
        for ($countEvent = 0;  $randomEvent > $countEvent; $countEvent++) {
            array_push($events, $event);
            $event->getAggregateId()->shouldBeCalled($randomEvent)->willReturn($aggregateId);
            $aggregateId->equals($aggregateId)->shouldBeCalled($randomEvent)->willReturn(true);
        }

        $this->shouldNotThrow(CorruptAggregateHistory::class)
            ->during__construct($aggregateId, $events);
    }

    public function it_should_get_aggregate_id()
    {
        $this->aggregateId()->shouldReturn($this->aggregateId);
    }

}
