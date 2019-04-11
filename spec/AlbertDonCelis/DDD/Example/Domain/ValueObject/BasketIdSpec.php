<?php

namespace spec\AlbertDonCelis\DDD\Example\Domain\ValueObject;

use AlbertDonCelis\DDD\Example\Domain\ValueObject\BasketId;
use Buttercup\Protects\IdentifiesAggregate;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;
use PHPUnit\Framework\Assert;
use Prophecy\Argument;

/**
 * Class PostIdSpec
 * @package spec\AlbertDonCelis\DDD\Example\Domain\ValueObject
 *
 * @mixin BasketId
 */
class BasketIdSpec extends ObjectBehavior
{
    /** @var Generator $faker */
    private $faker;

    function it_is_initializable()
    {
        $this->shouldHaveType(BasketId::class);
        $this->shouldHaveType(IdentifiesAggregate::class);
    }

    public function let()
    {
        $this->faker = Factory::create();

        $this->beConstructedWith($this->faker->uuid());
    }

    public function it_should_throw_exception_invalid_uuidv4()
    {
        $md5 = $this->faker->md5();
        $this->shouldThrow(\InvalidArgumentException::class)->during__construct($md5);
    }

    public function it_should_generate_new_uuid()
    {
        $this->beConstructedThrough('generate', []);
        $this->shouldNotThrow(\InvalidArgumentException::class)->duringInstantiation();
    }

    public function it_should_return_value()
    {
        $this->beConstructedWith($uuid = $this->faker->uuid());
        $this->__toString()->shouldReturn($uuid);
    }

    public function it_should_compare_the_value_of_two_object(IdentifiesAggregate $IDGeneratorInterface)
    {
        $IDGeneratorInterface->__toString()->shouldBeCalledTimes(1)->willReturn($this->__toString());
        $this->equals($IDGeneratorInterface)->shouldReturn(true);
    }

    public function it_should_create_an_identifier_object_from_the_string()
    {
        $identifier = Factory::create()->uuid();

        $this->beConstructedThrough('fromString', [ $identifier ]);

        Assert::assertTrue(($this->__toString() != ""));

    }

    public function it_should_throw_an_error_when_the_string_is_not_a_valid_uuid()
    {
        $identifier = Factory::create()->firstName();
        $this->shouldThrow(\InvalidArgumentException::class)->duringFromString($identifier);
    }
}
