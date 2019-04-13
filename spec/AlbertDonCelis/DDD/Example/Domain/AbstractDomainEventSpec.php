<?php
/**
 * Created by PhpStorm.
 * User: albert
 * Date: 2019-04-12
 * Time: 17:59
 */

namespace spec\AlbertDonCelis\DDD\Example\Domain;
use PhpSpec\ObjectBehavior;

abstract class AbstractDomainEventSpec extends ObjectBehavior
{

    abstract protected function aggregateId();

    public function it_should_return_identifies_Aggregate()
    {
        $this->getAggregateId()->shouldReturn($this->aggregateId());
    }

    public function it_should_get_event_name()
    {
        $this->eventName()->shouldReturn($this->domainEventName());
    }

    public function it_should_return_entity_type()
    {
        $this->entityType()->shouldReturn($this->domainEntityType());
    }
}