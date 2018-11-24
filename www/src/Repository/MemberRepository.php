<?php

namespace Devzone\Repository;

use Devzone\Entity\Member;
use Doctrine\ORM\QueryBuilder;

/**
 * Class MemberRepository
 * @package Devzone\Repository
 */
class MemberRepository extends BaseRepository
{

    protected $entityClass = Member::class;

    /**
     * @return QueryBuilder
     */
    public function getDataTableCountBuilder(): QueryBuilder
    {
        return $this->repository->createQueryBuilder('members')
            ->select('COUNT(members.id)')
            ->orderBy('members.id', 'ASC');
    }

    /**
     * @return QueryBuilder
     */
    public function getDataTableResultBuilder(): QueryBuilder
    {
        return $this->repository->createQueryBuilder('members')
            ->select('members.id', 'members.username', 'members.displayName')
            ->orderBy('members.id', 'ASC');
    }

}
