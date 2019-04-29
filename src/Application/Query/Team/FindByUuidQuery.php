<?php
declare(strict_types=1);

namespace App\Application\Query\Team;

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
