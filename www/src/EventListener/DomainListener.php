<?php

namespace Devzone\EventListener;

use Devzone\Entity\Domain;
use Devzone\Entity\Record;
use Devzone\Enum\RecordTypesEnum;
use Devzone\Service\Contract\Domain\NotifiedSerialInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\UnitOfWork;

/**
 * Class DomainListener
 * @package Devzone\EventListener
 */
class DomainListener implements EventSubscriber
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UnitOfWork
     */
    private $unitOfWork;

    /**
     * @var NotifiedSerialInterface
     */
    private $notifiedSerialGenerator;

    /**
     * DomainListener constructor.
     * @param NotifiedSerialInterface $notifiedSerial
     */
    public function __construct(NotifiedSerialInterface $notifiedSerial)
    {
        $this->notifiedSerialGenerator = $notifiedSerial;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [
            'onFlush',
        ];
    }

    /**
     * @param OnFlushEventArgs $eventArgs
     */
    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $this->entityManager = $eventArgs->getEntityManager();
        $this->unitOfWork = $this->entityManager->getUnitOfWork();

        $this->handleScheduledInserts($this->unitOfWork->getScheduledEntityInsertions());
        $this->handleScheduledUpdates($this->unitOfWork->getScheduledEntityUpdates());
    }

    /**
     * @param array $collection
     */
    private function handleScheduledInserts(array $collection)
    {
        $domainClassMetadata = null;
        $recordClassMetadata = null;

        foreach ($collection as $key => $entity) {
            if (!$entity instanceof Domain) {
                continue;
            }

            // Cache the class metadata in local variable in case we handle multiple Domain entities.
            if (!$domainClassMetadata || !$recordClassMetadata) {
                $domainClassMetadata = $this->entityManager->getClassMetadata(Domain::class);
                $recordClassMetadata = $this->entityManager->getClassMetadata(Record::class);
            }

            $entity->setNotifiedSerial($this->notifiedSerialGenerator->generate($entity));

            // Apply the changes and let the UnitOfWork do the rest.
            $this->entityManager->persist($entity);
            $this->unitOfWork->recomputeSingleEntityChangeSet($domainClassMetadata, $entity);

            // Create a default Record entity each time a new Domain (or zone) is created.
            // This can be easily achieved in regular EventSubscriber, but since we do
            // some modifications to the Domain entity here, we might as well take care of it here.
            $record = $this->createInitialDomainRecord($entity);

            $this->entityManager->persist($record);
            $this->unitOfWork->computeChangeSet($recordClassMetadata, $record);
        }
    }

    /**
     * @param array $collection
     */
    private function handleScheduledUpdates(array $collection)
    {
        $classMetadata = null;

        foreach ($collection as $key => $entity) {
            if (!$entity instanceof Domain) {
                continue;
            }

            if (!$classMetadata) {
                $classMetadata = $this->entityManager->getClassMetadata(Domain::class);
            }

            $entity->setNotifiedSerial($this->notifiedSerialGenerator->generate($entity));

            $this->entityManager->persist($entity);
            $this->unitOfWork->recomputeSingleEntityChangeSet($classMetadata, $entity);
        }
    }

    /**
     * @param Domain $domain
     *
     * @return Record
     */
    private function createInitialDomainRecord(Domain $domain): Record
    {
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

        return $entity;
    }

}
