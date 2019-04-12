<?php
/**
 * Created by PhpStorm.
 * User: albert
 * Date: 2019-04-12
 * Time: 08:07
 */

namespace spec\AlbertDonCelis\DDD\Example\Domain\ValueObject;

use Faker\Factory;
use PHPUnit\Framework\Assert;

trait IdTraitspec
{

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