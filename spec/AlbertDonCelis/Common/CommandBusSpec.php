<?php

namespace spec\AlbertDonCelis\Common;

use AlbertDonCelis\Common\CommandBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use AlbertDonCelis\Application\Command\CommandHandlerInterface;
use AlbertDonCelis\Application\Command\CommandInterface;


class CommandBusSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CommandBus::class);
    }

    public function it_should_register_a_command_handler(CommandHandlerInterface $commandHandler)
    {
        $this->shouldNotThrow()->duringRegisterHandler($commandHandler);
    }

    public function it_should_not_register_a_duplicate_commandHandler()
    {
        $this->registerHandler(new DummyCommandHandler());

        $this->shouldThrow(CommandHandlerIsDuplicateException::class)
            ->duringRegisterHandler(new DummyCommandHandler());
    }
}

class DummyCommandHandler implements CommandHandlerInterface {

    public function handle(CommandInterface $command): void {}
}