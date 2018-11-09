<?php

namespace Devzone\EventSubscriber\Record;

use Devzone\Entity\Record;
use Devzone\Enum\Events;
use Devzone\Enum\RecordTypesEnum;
use Devzone\Event\Domain\DomainCreatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class InitialRecordSubscriber
 * @package Devzone\EventSubscriber\Record
 */
class InitialRecordSubscriber implements EventSubscriberInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * InitialRecordSubscriber constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            Events::ON_DOMAIN_CREATED => 'onDomainCreated',
        ];
    }

    /**
     * @param DomainCreatedEvent $event
     */
    public function onDomainCreated(DomainCreatedEvent $event)
    {
        $domain = $event->getEntity();

        $entity = new Record();
        $entity->setDomain($domain);
        $entity->setName($domain->getName());
        $entity->setType(RecordTypesEnum::TYPE_SOA);
        $entity->setContent(
            join(' ', array_map('trim', [
                $domain->getPrimary(),
                $domain->getEmail(),
                $domain->getNotifiedSerial(),
                $domain->getRefresh(),
                $domain->getRetry(),
                $domain->getExpire(),
                $domain->getTtl()
            ]))
        );

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

}
