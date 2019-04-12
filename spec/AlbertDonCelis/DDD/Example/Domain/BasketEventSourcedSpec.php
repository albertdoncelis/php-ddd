<?php

namespace spec\AlbertDonCelis\DDD\Example\Domain;

use AlbertDonCelis\DDD\Domain\AbstractEventSourced;
use AlbertDonCelis\DDD\Example\Domain\BasketEventSourced;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\BasketId;
use Buttercup\Protects\DomainEvents;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ExampleEventSourcedSpec
 * @package spec\AlbertDonCelis\DDD\Example
 *
 * @mixin BasketEventSourced
 */
class BasketEventSourcedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BasketEventSourced::class);
        $this->shouldHaveType(AbstractEventSourced::class);
    }

    public function let(BasketId $basketId)
    {
        $this->beConstructedThrough('pickUp', [ $basketId ]);
    }

    public function it_should_clear_record_of_events()
    {
        $this->clearRecordedEvents()->shouldBeNull();
    }

    public function it_should_return_domain_events()
    {
        $this->getRecordedEvents()->shouldHaveType(DomainEvents::class);
    }

    public function it_should_get_the_events_from_the_basket(BasketId $basketId)
    {
        $this->beConstructedThrough('pickUp', [ $basketId ]);

        $this->getRecordedEvents()->count()->shouldReturn(1);
    }
}
