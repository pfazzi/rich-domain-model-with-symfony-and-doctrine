<?php
declare(strict_types=1);

namespace App\Infrastructure\League\Repository;


use App\Domain\League\League;
use App\Domain\League\LeagueRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

final class DoctrineLeagueRepository implements LeagueRepositoryInterface
{
    public function get(UuidInterface $uuid): League
    {
        // TODO: Implement get() method.
    }

    public function store(League $user): void
    {
        // TODO: Implement store() method.
    }
}