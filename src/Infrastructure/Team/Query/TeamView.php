<?php
declare(strict_types=1);

namespace App\Infrastructure\Team\Query;

use App\Domain\Team\Query\TeamViewInterface;
use App\Domain\Team\Team;

final class TeamView implements TeamViewInterface
{
    /** @var Team */
    private $team;

    /**
     * TeamView constructor.
     *
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function uuid(): string
    {
        return $this->team->uuid()->toString();
    }

    public function name(): string
    {
        return $this->team->name()->toString();
    }
}
