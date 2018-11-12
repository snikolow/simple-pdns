<?php

namespace Devzone\EventListener;

use Devzone\Entity\Record;
use Devzone\Enum\RecordTypesEnum;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\UnitOfWork;

/**
 * Class RecordListener
 * @package Devzone\EventListener
 */
class RecordListener implements EventSubscriber
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
     * {@inheritdoc}
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

        $this->updateContentForSOARecord($this->unitOfWork->getScheduledEntityUpdates());
    }

    /**
     * @param array $collection
     */
    private function updateContentForSOARecord(array $collection)
    {
        $recordMetadata = null;

        foreach ($collection as $key => $entity) {
            if (!$entity instanceof Record) {
                continue;
            }

            // Update only record of type SOA, because this is the one that the system should handle
            // automatically and prevent the user from providing the content.
            if ($entity->getType() !== RecordTypesEnum::TYPE_SOA) {
                continue;
            }

            if (!$recordMetadata) {
                $recordMetadata = $this->entityManager->getClassMetadata(Record::class);
            }

            $domain = $entity->getDomain();

            $entity->setTtl($domain->getTtl());
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

            $this->entityManager->persist($entity);
            $this->unitOfWork->recomputeSingleEntityChangeSet($recordMetadata, $entity);
        }
    }

}
