<?php

namespace spec\AlbertDonCelis\DDD\Example\Domain;

use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Example\Domain\BasketWasPickedUp;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\BasketId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class BasketWasPickedUpSpec
 * @package spec\AlbertDonCelis\DDD\Example\Domain
 *
 * @mixin BasketWasPickedUp
 */
class BasketWasPickedUpSpec extends ObjectBehavior
{
    /** @var BasketId $basketId */
    private $basketId;

    function it_is_initializable()
    {
        $this->shouldHaveType(BasketWasPickedUp::class);
        $this->shouldImplement(DomainEventInterface::class);
    }

    public function let(BasketId $basketId)
    {
        $this->basketId = $basketId;
        $this->beConstructedWith($basketId);
    }

    public function it_should_return_identifies_Aggregate()
    {
        $this->getAggregateId()->shouldReturn($this->basketId);
    }

    public function it_should_get_event_name()
    {
        $this->eventName()->shouldReturn('BasketWasPickedUp');
    }

    public function it_should_return_entity_type()
    {
        $this->entityType()->shouldReturn('Basket');
    }
}
