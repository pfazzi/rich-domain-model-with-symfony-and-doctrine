<?php

namespace App\Application\Query\League;

use App\Domain\League\Query\LeagueViewInterface;
use App\Domain\League\Query\LeagueViewRepositoryInterface;

final class FindByUuidHandler
{
    /** @var LeagueViewRepositoryInterface */
    private $repository;

    public function __construct(LeagueViewRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindByUuidQuery $query): LeagueViewInterface
    {
        return $this->repository->oneByUuid($query->uuid());
    }
}
