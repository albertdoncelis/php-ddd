<?php

namespace spec\AlbertDonCelis\DDD\Shared\Domain\ValueObject;

use AlbertDonCelis\DDD\Shared\Domain\ValueObject\Uuid;
use Faker\Factory;
use Faker\Generator;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UuidSpec
 * @package spec\AlbertDonCelis\DDD\Shared\Domain\ValueObject
 *
 * @mixin Uuid
 */
class UuidSpec extends ObjectBehavior
{

    /** @var Generator $faker */
    private $faker;

    function it_is_initializable()
    {
        $this->shouldHaveType(Uuid::class);
    }

    public function let()
    {
        $this->faker = Factory::create();

        $this->beConstructedWith($this->faker->uuid());
    }

    public function it_should_throw_exception_invalid_uuidv4()
    {
        $md5 = $this->faker->md5();
        $this->shouldThrow(InvalidArgumentException::class)->during__construct($md5);
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
}
