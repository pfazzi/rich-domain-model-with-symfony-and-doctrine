<?php

namespace App\Application\Query\League;

use Ramsey\Uuid\Uuid;

final class FindByUuidQuery
{
    /** @var Uuid */
    private $uuid;

    /**
     * FindByUuidQuery constructor.
     *
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->uuid = Uuid::fromString($uuid);
    }

    public function uuid(): Uuid
    {
        return $this->uuid;
    }
}
