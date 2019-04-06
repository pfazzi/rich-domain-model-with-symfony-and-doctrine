<?php

declare(strict_types=1);

namespace App\Application\League;

use App\Domain\League\Name;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class RegisterLeagueCommand
{
    /** @var UuidInterface */
    private $uuid;

    /** @var Name */
    private $name;

    public function __construct(string $uuid, string $name)
    {
        $this->uuid = Uuid::fromString($uuid);
        $this->name = Name::fromString($name);
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function name(): Name
    {
        return $this->name;
    }
}
