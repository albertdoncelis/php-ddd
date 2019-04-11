<?php
/**
 * Created by PhpStorm.
 * User: albert
 * Date: 2019-04-11
 * Time: 08:04
 */

namespace AlbertDonCelis\DDD\Infrastructure\Projection;

use AlbertDonCelis\DDD\Domain\DomainEventInterface;

interface ProjectionInterface
{
    public function listenToEventNameOf(): string;

    public function project(DomainEventInterface $event): void;
}
