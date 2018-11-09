<?php

namespace Devzone\EventListener;

use Devzone\Entity\Domain;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class DomainListener
 * @package Devzone\EventListener
 */
class DomainListener implements EventSubscriber
{

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [
            'prePersist',
            'preUpdate',
        ];
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if (!$entity instanceof Domain) {
            return;
        }

        $entity->setNotifiedSerial(2018110700);
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function preUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if (!$entity instanceof Domain) {
            return;
        }
    }

}
