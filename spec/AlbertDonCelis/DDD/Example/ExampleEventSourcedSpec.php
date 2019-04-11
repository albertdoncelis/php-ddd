<?php

namespace spec\AlbertDonCelis\DDD\Example;

use AlbertDonCelis\DDD\Domain\AbstractEventSourced;
use AlbertDonCelis\DDD\Example\ExampleEventSourced;
use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\ImmutableArray;
use PhpSpec\ObjectBehavior;
use PHPUnit\Framework\Assert;
use Prophecy\Argument;

/**
 * Class ExampleEventSourcedSpec
 * @package spec\AlbertDonCelis\DDD\Example
 *
 * @mixin ExampleEventSourced
 */
class ExampleEventSourcedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ExampleEventSourced::class);
        $this->shouldHaveType(AbstractEventSourced::class);
    }

    public function it_should_clear_record_of_events()
    {
        $this->clearRecordedEvents()->shouldBeNull();
    }

    public function it_should_return_domain_events()
    {
        $this->getRecordedEvents()->shouldHaveType(DomainEvents::class);
    }
}
