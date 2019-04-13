<?php
/**
 * Created by PhpStorm.
 * User: albert
 * Date: 2019-04-13
 * Time: 07:46
 */

namespace AlbertDonCelis\DDD\Domain;

use Buttercup\Protects\DomainEvent;
use Verraes\ClassFunctions\ClassFunctions;

trait ApplyThatTraits
{

    /**
     * @param DomainEvent $event
     */
    protected function applyThat(DomainEvent $event): void
    {
        $method = 'applyThat' . ClassFunctions::short($event);
        $this->$method($event);
    }
}
