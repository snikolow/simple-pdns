<?php

namespace Devzone\Service\DataTable;

use Devzone\Entity\Domain;
use Devzone\Repository\RecordRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Class RecordDataTable
 * @package Devzone\Service\DataTable
 */
class RecordDataTable extends BaseDataTable
{

    /**
     * @var Domain
     */
    private $domain;

    /**
     * RecordDataTable constructor.
     * @param RecordRepository $repositorye
     */
    public function __construct(RecordRepository $repositorye)
    {
        $this->repository = $repositorye;
    }

    /**
     * @param Domain $domain
     *
     * @return RecordDataTable
     */
    public function setDomain(Domain $domain): RecordDataTable
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return QueryBuilder
     */
    protected function getDefaultQueryBuilder(): QueryBuilder
    {
        return $this->repository->getDataTableResultBuilder($this->domain);
    }

    /**
     * @return QueryBuilder
     */
    protected function getDefaultCountQueryBuilder(): QueryBuilder
    {
        return $this->repository->getDataTableCountBuilder($this->domain);
    }

}
