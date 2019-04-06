<?php

declare(strict_types=1);

namespace App\Infrastructure\League\Repository;

use App\Domain\League\League;
use App\Domain\League\LeagueRepositoryInterface;
use App\Infrastructure\Shared\Repository\DoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

final class DoctrineLeagueRepository extends DoctrineRepository implements LeagueRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, League::class);
    }

    /**
     * @param UuidInterface $uuid
     *
     * @return League
     * @throws \App\Domain\Shared\Exception\NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function get(UuidInterface $uuid): League
    {
        $queryBuilder = $this
            ->getRepository()
            ->createQueryBuilder('user')
            ->where('user.uuid = :uuid')
            ->setParameter('uuid', $uuid->getBytes())
        ;

        return $this->oneOrException($queryBuilder);
    }

    public function store(League $user): void
    {
        $this->register($user);
    }
}
