<?php

namespace App\Domain\League\Query;

interface LeagueViewInterface
{
    public function uuid(): string;

    public function name(): string;
}
