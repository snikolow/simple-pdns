<?php

namespace Devzone\Service\DataTable;

use Devzone\Repository\DomainRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Class DomainDataTable
 * @package Devzone\Service\DataTable
 */
class DomainDataTable extends BaseDataTable
{

    /**
     * DomainDataTable constructor.
     * @param DomainRepository $repository
     */
    public function __construct(DomainRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return QueryBuilder
     */
    protected function getDefaultQueryBuilder(): QueryBuilder
    {
        return $this->repository->getDataTableResultBuilder();
    }

    /**
     * @return QueryBuilder
     */
    protected function getDefaultCountQueryBuilder(): QueryBuilder
    {
        return $this->repository->getDataTableCountBuilder();
    }

}
