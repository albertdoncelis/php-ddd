<?php

namespace spec\AlbertDonCelis\DDD\Example\Domain\ValueObject;

use AlbertDonCelis\DDD\Example\Domain\ValueObject\ProductId;
use Buttercup\Protects\IdentifiesAggregate;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;
use PHPUnit\Framework\Assert;
use Prophecy\Argument;

class ProductIdSpec extends ObjectBehavior
{
    use IdTraitSpec;

    /** @var Generator $faker */
    private $faker;

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductId::class);
        $this->shouldHaveType(IdentifiesAggregate::class);
    }

    public function let()
    {
        $this->faker = Factory::create();

        $this->beConstructedWith($this->faker->uuid());
    }

    public function it_should_compare_the_value_of_two_object(IdentifiesAggregate $IDGeneratorInterface)
    {
        $IDGeneratorInterface->__toString()->shouldBeCalledTimes(1)->willReturn($this->__toString());
        $this->equals($IDGeneratorInterface)->shouldReturn(true);
    }

}
