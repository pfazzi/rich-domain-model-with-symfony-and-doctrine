<?php

namespace App\Domain\Team;

use App\Domain\Shared\Country;
use App\Domain\Shared\Name;
use Ramsey\Uuid\UuidInterface;

final class Team
{
    /** @var UuidInterface */
    private $uuid;

    /** @var Name */
    private $name;

    /** @var Country */
    private $country;

    public function __construct(UuidInterface $uuid, Name $name, Country $country)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->country = $country;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function country(): Country
    {
        return $this->country;
    }
}
