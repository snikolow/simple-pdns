<?php

namespace Devzone\Service\Contract\Domain;

use Devzone\Entity\Domain;

/**
 * Interface NotifiedSerialInterface
 * @package Devzone\Service\Contract\Domain
 */
interface NotifiedSerialInterface
{

    /**
     * Generates the serial number based on the entity state.
     *
     * @param Domain $entity
     *
     * @return int
     */
    public function generate(Domain $entity): int;

}
