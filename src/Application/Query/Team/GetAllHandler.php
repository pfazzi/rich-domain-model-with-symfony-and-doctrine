<?php

namespace App\Application\Query\Team;

use App\Domain\Team\Query\TeamViewRepositoryInterface;

final class GetAllHandler
{
    /** @var TeamViewRepositoryInterface */
    private $repository;

    /**
     * GetAllHandler constructor.
     *
     * @param TeamViewRepositoryInterface $repository
     */
    public function __construct(TeamViewRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetAllQuery $query)
    {
        return $this->repository->getAll();
    }
}
