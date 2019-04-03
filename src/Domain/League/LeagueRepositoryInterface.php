<?php
declare(strict_types=1);

namespace App\Domain\League;


use Ramsey\Uuid\UuidInterface;

interface LeagueRepositoryInterface
{
    public function get(UuidInterface $uuid): League;

    public function store(League $user): void;
}