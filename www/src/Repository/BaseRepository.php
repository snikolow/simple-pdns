<?php

namespace Devzone\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * An abstract implementation of the EntityRepository logic.
 * Instead of relying on the EntityRepository class as a base,
 * we will use the EntityManagerInterface to create the instance
 * of the desired repository for us. This way, we can take advantage
 * of the autowire configuration and inject a repository directly
 * to the constructor or controller action.
 *
 * Class BaseRepository
 * @package Devzone\Repository
 */
abstract class BaseRepository
{

    /**
     * The class name of the entity.
     *
     * Override this in the child repository classes in order to
     * assign the an instance of EntityRepository automatically.
     *
     * @var string
     */
    protected $entityClass = null;

    /**
     * @var EntityRepository
     */
    protected $repository = null;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * BaseRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        if ($this->entityManager) {
            $this->repository = $this->entityManager->getRepository($this->entityClass);
        }
    }

}
