<?php

namespace Devzone\Service\DataTable;

use Devzone\Repository\MemberRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Class MemberDataTable
 * @package Devzone\Service\DataTable
 */
class MemberDataTable extends BaseDataTable
{

    /**
     * RecordDataTable constructor.
     * @param MemberRepository $repository
     */
    public function __construct(MemberRepository $repository)
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
