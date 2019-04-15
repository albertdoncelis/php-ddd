<?php

namespace spec\AlbertDonCelis\DDD\Example\Domain;

use AlbertDonCelis\DDD\Domain\DomainEventInterface;
use AlbertDonCelis\DDD\Example\Domain\ProductWasAddedToBasket;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\BasketId;
use AlbertDonCelis\DDD\Example\Domain\ValueObject\ProductId;
use Buttercup\Protects\IdentifiesAggregate;
use Faker\Factory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ProductWasAddedToBasketSpec
 * @package spec\AlbertDonCelis\DDD\Example\Domain
 *
 * @mixin ProductWasAddedToBasket
 */
class ProductWasAddedToBasketSpec extends AbstractDomainEventSpec
{

    /** @var BasketId $basketId */
    private $basketId;

    /** @var ProductId $productId */
    private $productId;

    /** @var string $productName */
    private $productName;

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductWasAddedToBasket::class);
        $this->shouldImplement(DomainEventInterface::class);
    }

    public function let(BasketId $basketId, ProductId $productId)
    {
        $this->productId = $productId;
        $this->basketId = $basketId;
        $this->productName = Factory::create()->firstName();
        $this->beConstructedWith($basketId, $productId, $this->productName);
    }

    public function it_should_return_product_name()
    {
        $this->productName()->shouldReturn($this->productName);
    }

    public function it_should_return_productId()
    {
        $this->productId()->shouldReturn($this->productId);
    }

    protected function aggregateId()
    {
        return $this->basketId;
    }

    protected function domainEventName(): string
    {
        return "ProductWasAddedToBasket";
    }

    protected function domainEntityType(): string
    {
        return "Basket";
    }

    protected function arrayData(): array
    {
        return [];
    }
}
