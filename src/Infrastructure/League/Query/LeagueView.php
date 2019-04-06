<?php
declare(strict_types=1);

namespace App\Infrastructure\League\Query;

use App\Domain\League\Query\LeagueViewInterface;

final class LeagueView implements LeagueViewInterface
{
    /** @var string */
    public $uuid;

    /** @var string */
    public $name;

    /**
     * LeagueView constructor.
     *
     * @param string $uuid
     * @param string $name
     */
    public function __construct(string $uuid, string $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }
}
