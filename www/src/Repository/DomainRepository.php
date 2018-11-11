<?php

namespace Devzone\Repository;

use Devzone\Entity\Domain;
use Doctrine\ORM\QueryBuilder;

/**
 * Class DomainRepository
 * @package Devzone\Repository
 */
class DomainRepository extends BaseRepository
{

    protected $entityClass = Domain::class;

    /**
     * @return QueryBuilder
     */
    public function getDataTableCountBuilder(): QueryBuilder
    {
        return $this->repository->createQueryBuilder('domain')
            ->select('COUNT(domain.id)')
            ->orderBy('domain.id', 'ASC');
    }

    /**
     * @return QueryBuilder
     */
    public function getDataTableResultBuilder(): QueryBuilder
    {
        return $this->repository->createQueryBuilder('domain')
            ->select('domain.id', 'domain.name')
            ->orderBy('domain.id', 'ASC');
    }

}
