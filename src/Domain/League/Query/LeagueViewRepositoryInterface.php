<?php
declare(strict_types=1);

namespace App\Domain\League\Query;

use Ramsey\Uuid\UuidInterface;

interface LeagueViewRepositoryInterface
{
    public function oneByUuid(UuidInterface $uuid): LeagueViewInterface;
}
