<?php

namespace AlbertDonCelis\Application\Command;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command): void;
}
