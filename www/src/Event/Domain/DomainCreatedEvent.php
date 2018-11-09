<?php

namespace Devzone\Event\Domain;

use Devzone\Entity\Domain;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class DomainCreatedEvent
 * @package Devzone\Event\Domain
 */
class DomainCreatedEvent extends Event
{

    /**
     * @var Domain
     */
    private $entity;

    /**
     * DomainCreatedEvent constructor.
     * @param \Devzone\Entity\Domain $entity
     */
    public function __construct(Domain $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return \Devzone\Entity\Domain
     */
    public function getEntity(): Domain
    {
        return $this->entity;
    }

}
