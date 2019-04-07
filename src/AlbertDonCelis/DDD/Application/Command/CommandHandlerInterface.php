<?php

namespace AlbertDonCelis\DDD\Application\Command;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command): void;
}
