<?php

declare(strict_types=1);

namespace App\Infrastructure\League\Repository;

use App\Domain\League\League;
use App\Domain\League\LeagueRepositoryInterface;
use App\Domain\League\Query\LeagueViewInterface;
use App\Domain\League\Query\LeagueViewRepositoryInterface;
use App\Infrastructure\League\Query\TeamView;
use App\Infrastructure\Shared\Repository\DoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

final class DoctrineLeagueRepository extends DoctrineRepository implements LeagueRepositoryInterface, LeagueViewRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, League::class);
    }

    /**
     * @param UuidInterface $uuid
     *
     * @return League
     *
     * @throws \App\Domain\Shared\Exception\NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function get(UuidInterface $uuid): League
    {
        $queryBuilder = $this
            ->getRepository()
            ->createQueryBuilder('l')
            ->where('l.uuid = :uuid')
            ->setParameter('uuid', $uuid->getBytes())
        ;

        return $this->oneOrException($queryBuilder);
    }

    public function store(League $league): void
    {
        $this->register($league);
    }

    /**
     * @param UuidInterface $uuid
     *
     * @return LeagueViewInterface
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function oneByUuid(UuidInterface $uuid): LeagueViewInterface
    {
        $qb = $this
            ->getEntityManager()
            ->createQueryBuilder();

        $viewClass = TeamView::class;

        $qb
            ->select("NEW {$viewClass}(l.uuid, l.name.value)")
            ->from(League::class, 'l')
            ->where('l.uuid = :uuid')
            ->setParameter('uuid', $uuid->toString())
        ;

        return $qb->getQuery()->getSingleResult();
    }
}
