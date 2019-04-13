<?php
/**
 * Created by PhpStorm.
 * User: albert
 * Date: 2019-04-13
 * Time: 10:54
 */

namespace AlbertDonCelis\DDD\Domain;

interface EventSourcedInterface
{
    public static function reconstituteFrom(History $aggregateHistory);
}
