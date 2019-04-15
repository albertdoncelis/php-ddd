<?php
/**
 * Created by PhpStorm.
 * User: albert
 * Date: 2019-04-15
 * Time: 09:33
 */

namespace AlbertDonCelis\DDD\Infrastructure\EventStore;

use AlbertDonCelis\DDD\Domain\History;
use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\IdentifiesAggregate;

interface EventStoreInterface
{
    public function commit(DomainEvents $domainEvents): void;
}
