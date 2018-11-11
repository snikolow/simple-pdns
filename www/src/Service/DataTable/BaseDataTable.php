<?php

namespace Devzone\Service\DataTable;

use Devzone\Repository\BaseRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BaseDataTable
 * @package Devzone\Service\DataTable
 */
abstract class BaseDataTable
{

    /**
     * @var BaseRepository
     */
    protected $repository;

    /**
     * @var int
     */
    protected $recordsPerPage = 10;

    /**
     * @var Request
     */
    private $request;

    /**
     * @return QueryBuilder
     */
    abstract protected function getDefaultQueryBuilder(): QueryBuilder;

    /**
     * @return QueryBuilder
     */
    abstract protected function getDefaultCountQueryBuilder(): QueryBuilder;

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->getDefaultQueryBuilder()
            ->setMaxResults($this->recordsPerPage)
            ->setFirstResult($this->getFirstResult())
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return int
     */
    public function countAll(): int
    {
        return $this->getDefaultCountQueryBuilder()
            ->getQuery()
            ->useQueryCache(true)
            ->useResultCache(true, 3600)
            ->getSingleScalarResult();
    }

    /**
     * @param Request $request
     *
     * @return BaseDataTable
     */
    public function setRequest(Request $request): BaseDataTable
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return int
     */
    public function getRecordsPerPage(): int
    {
        return $this->recordsPerPage;
    }

    /**
     * @return int
     */
    private function getFirstResult(): int
    {
        $attributes = $this->getRequest()->query;

        if (
            !$attributes->has('start')
            || (!$start = $attributes->getInt('start', 0)))
        {
            $start = 0;
        }

        return (intval($start * $this->recordsPerPage));
    }

}
