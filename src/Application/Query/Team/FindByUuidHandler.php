<?php
declare(strict_types=1);

namespace App\Application\Query\Team;

use App\Domain\Team\Query\TeamViewInterface;
use App\Domain\Team\Query\TeamViewRepositoryInterface;

final class FindByUuidHandler
{
    /** @var TeamViewRepositoryInterface */
    private $repository;

    public function __construct(TeamViewRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindByUuidQuery $query): TeamViewInterface
    {
        return $this->repository->oneByUuid($query->uuid());
    }
}
