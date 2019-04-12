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
class BasketWasPickedUpSpec extends AbstractDomainEventSpec
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

    protected function aggregateId()
    {
        return $this->basketId;
    }

    protected function domainEventName(): string
    {
        return 'BasketWasPickedUp';
    }

    protected function domainEntityType(): string
    {
        return "Basket";
    }
}
