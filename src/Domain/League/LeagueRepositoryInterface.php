<?php
declare(strict_types=1);

namespace App\Domain\League;

use Ramsey\Uuid\UuidInterface;

interface LeagueRepositoryInterface
{
    /**
     * @param UuidInterface $uuid
     *
     * @return League
     *
     * @throws \App\Domain\Shared\Exception\NotFoundException
     */
    public function get(UuidInterface $uuid): League;

    public function store(League $league): void;
}
