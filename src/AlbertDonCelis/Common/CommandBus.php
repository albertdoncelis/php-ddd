<?php

namespace AlbertDonCelis\Common;

use AlbertDonCelis\Application\Command\CommandHandlerInterface;
use spec\AlbertDonCelis\Common\CommandHandlerIsDuplicateException;

class CommandBus
{
    private $commandHandlers = [];

    /**
     * @param CommandHandlerInterface $commandHandler
     * @return $this
     */
    public function registerHandler(CommandHandlerInterface $commandHandler): self
    {
        $className = get_class($commandHandler);

        if (array_key_exists($className, $this->commandHandlers)) {

            throw new CommandHandlerIsDuplicateException();
        }

        $this->commandHandlers[$className] = $commandHandler;

        return $this;
    }
}
