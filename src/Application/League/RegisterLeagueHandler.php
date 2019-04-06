<?php

declare(strict_types=1);

namespace App\Application\League;

use App\Domain\League\League;
use App\Domain\League\LeagueRepositoryInterface;

final class RegisterLeagueHandler
{
    /** @var LeagueRepositoryInterface */
    private $repository;

    public function __construct(LeagueRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RegisterLeagueCommand $command): void
    {
        $league = new League($command->uuid(), $command->name());

        $this->repository->store($league);
    }
}
