<?php

declare(strict_types=1);

namespace App\Application\Command\Team;

use App\Domain\Team\Team;
use App\Domain\Team\TeamRepositoryInterface;

final class RegisterTeamHandler
{
    /** @var TeamRepositoryInterface */
    private $repository;

    public function __construct(TeamRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RegisterTeamCommand $command): void
    {
        $league = new Team($command->uuid(), $command->name(), $command->country());

        $this->repository->store($league);
    }
}
