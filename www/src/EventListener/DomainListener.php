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
        $domainClassMetadata = null;
        $recordClassMetadata = null;

        foreach ($collection as $key => $entity) {
            if (!$entity instanceof Domain) {
                continue;
            }

            if (!$domainClassMetadata || !$$recordClassMetadata) {
                $domainClassMetadata = $this->entityManager->getClassMetadata(Domain::class);
                $recordClassMetadata = $this->entityManager->getClassMetadata(Record::class);
            }

            $entity->setNotifiedSerial($this->notifiedSerialGenerator->generate($entity));

            $this->entityManager->persist($entity);
            $this->unitOfWork->recomputeSingleEntityChangeSet($domainClassMetadata, $entity);

            if ($record = $this->updateInitialDomainRecord($entity)) {
                $this->unitOfWork->recomputeSingleEntityChangeSet($recordClassMetadata, $record);
            }
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
        $entity->setTtl($domain->getTtl());
        $entity->setName($domain->getName());
        $entity->setType(RecordTypesEnum::TYPE_SOA);
        $entity->setContent(
            join(' ', array_map('trim', [
                $domain->getPrimaryRecord(),
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

    /**
     * Update the initial Record for given domain.
     *
     * This is a required step only for a Record with type "SOA", since it's "content"
     * is managed automatically, based on the data provided for the related domain.
     *
     * For records with type other than "SOA", this step is not necessary, because
     * "content" will be provided on form submission.
     *
     * @param Domain $domain
     *
     * @return Record|null
     */
    private function updateInitialDomainRecord(Domain $domain): ?Record
    {
        // Creating a query builder outside it's repository in most cases is considered against best practices.
        // But in this case, we are using a different approach for managing Entity Repositories, one that would
        // allow us to use Repositories in Services/Actions a lot more easily.
        // In this case, if we try to inject RecordRepository as a direct dependency to this class, in general
        // we will break the system by entering in Circular reference for EntityManager. Doctrine event listeners
        // requires the EntityManager to be presented in all times, and we also depend on it in our BaseRepository -
        // thus, entering in circular reference. Relying on the whole container is not a good idea as well.
        // So, for the time being, this will remain as it is, until I figure out a better solution.
        $record = $this->entityManager->createQueryBuilder()
            ->select('record')
            ->from('Devzone:Record', 'record')
            ->innerJoin('record.domain', 'domain')
            ->where('domain.id = :domainId')
            ->andWhere('record.type = :type')
            ->setParameters([
                'domainId' => $domain->getId(),
                'type' => RecordTypesEnum::TYPE_SOA,
            ])
            ->getQuery()
            ->getSingleResult();

        if (!$record instanceof Record) {
            return null;
        }

        $record->setContent(
            join(' ', array_map('trim', [
                $domain->getPrimaryRecord(),
                $domain->getEmail(),
                $domain->getNotifiedSerial(),
                $domain->getRefresh(),
                $domain->getRetry(),
                $domain->getExpire(),
                $domain->getTtl()
            ]))
        );

        return $record;
    }

}
