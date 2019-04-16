<?php
/**
 * Created by PhpStorm.
 * User: albert
 * Date: 2019-04-16
 * Time: 08:37
 */

namespace AlbertDonCelis\DDD\Domain;

use Buttercup\Protects\RecordsEvents;

interface AggregateRepositoryInterface
{

//    /**
//     * @param IdentifiesAggregate $identifiesAggregate
//     * @return EventSourcedInterface
//     */
//    public function get(IdentifiesAggregate $identifiesAggregate): EventSourcedInterface;

    /**
     * @param RecordsEvents $recordEvents
     */
    public function saveEventSourced(RecordsEvents $recordEvents): void;
}
