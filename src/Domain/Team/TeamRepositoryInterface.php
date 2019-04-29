<?php

namespace App\Domain\Team;

use Ramsey\Uuid\UuidInterface;

interface TeamRepositoryInterface
{
    /**
     * @param UuidInterface $uuid
     *
     * @return Team
     *
     * @throws \App\Domain\Shared\Exception\NotFoundException
     */
    public function get(UuidInterface $uuid): Team;

    public function store(Team $team): void;
}
