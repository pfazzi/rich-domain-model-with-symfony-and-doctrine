<?php

namespace App\Infrastructure\Team\Repository;

use App\Domain\Team\Query\TeamViewInterface;
use App\Domain\Team\Query\TeamViewRepositoryInterface;
use App\Domain\Team\Team;
use App\Domain\Team\TeamRepositoryInterface;
use App\Infrastructure\Shared\Repository\DoctrineRepository;
use App\Infrastructure\Team\Query\TeamView;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

final class DoctrineTeamRepository extends DoctrineRepository implements TeamRepositoryInterface, TeamViewRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Team::class);
    }

    /**
     * @param UuidInterface $uuid
     *
     * @return Team
     *
     * @throws \App\Domain\Shared\Exception\NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function get(UuidInterface $uuid): Team
    {
        $queryBuilder = $this
            ->getRepository()
            ->createQueryBuilder('team')
            ->where('team.uuid = :uuid')
            ->setParameter('uuid', $uuid->getBytes())
        ;

        return $this->oneOrException($queryBuilder);
    }

    public function store(Team $team): void
    {
        $this->register($team);
    }

    /**
     * @param UuidInterface $uuid
     *
     * @return TeamViewInterface
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \App\Domain\Shared\Exception\NotFoundException
     */
    public function oneByUuid(UuidInterface $uuid): TeamViewInterface
    {
        return new TeamView($this->get($uuid));
    }

    /**
     * @return TeamViewInterface[]
     */
    public function getAll(): array
    {
        $result = $this
            ->getRepository()
            ->createQueryBuilder('team')
            ->getQuery()
            ->execute()
        ;

        return array_map(function (Team $team): TeamView {
            return new TeamView($team);
        }, $result);
    }
}
