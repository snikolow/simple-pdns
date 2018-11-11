<?php

namespace Devzone\Repository;

use Devzone\Entity\Domain;
use Devzone\Entity\Record;
use Doctrine\ORM\QueryBuilder;

/**
 * Class RecordRepository
 * @package Devzone\Repository
 */
class RecordRepository extends BaseRepository
{

    protected $entityClass = Record::class;

    /**
     * @param Domain $domain
     *
     * @return QueryBuilder
     */
    public function getDataTableCountBuilder(Domain $domain): QueryBuilder
    {
        return $this->getBaseQueryBuilder($domain)
            ->select('COUNT(record.id)');
    }

    /**
     * @param Domain $domain
     *
     * @return QueryBuilder
     */
    public function getDataTableResultBuilder(Domain $domain): QueryBuilder
    {
        return $this->getBaseQueryBuilder($domain)
            ->select('record.id', 'record.name');
    }

    /**
     * @param Domain $domain
     *
     * @return QueryBuilder
     */
    private function getBaseQueryBuilder(Domain $domain): QueryBuilder
    {
        return $this->repository->createQueryBuilder('record')
            ->innerJoin('record.domain', 'domain')
            ->where('domain.id = :domainId')
            ->setParameter('domainId', $domain->getId())
            ->orderBy('record.id', 'ASC');
    }

}
