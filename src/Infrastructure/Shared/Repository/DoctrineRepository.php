<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Repository;

use App\Domain\Shared\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;

abstract class DoctrineRepository
{
    /** @var string */
    private $class;

    /** @var EntityRepository */
    private $repository;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, string $entityClass)
    {
        $this->class = $entityClass;
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository($this->class);
    }

    protected function register(object $model): void
    {
        $this->entityManager->persist($model);
        $this->entityManager->flush();
    }

    /**
     * @param QueryBuilder $queryBuilder
     *
     * @return mixed
     *
     * @throws NotFoundException
     * @throws NonUniqueResultException
     */
    protected function oneOrException(QueryBuilder $queryBuilder)
    {
        $model = $queryBuilder
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if (null === $model) {
            throw new NotFoundException();
        }

        return $model;
    }

    protected function getRepository(): EntityRepository
    {
        return $this->repository;
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
}
