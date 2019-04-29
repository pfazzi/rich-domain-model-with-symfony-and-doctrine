<?php

declare(strict_types=1);

namespace App\Application\Command\Team;

use App\Domain\Shared\Country;
use App\Domain\Shared\Name;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class RegisterTeamCommand
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var Country
     */
    private $country;

    /**
     * RegisterTeamCommand constructor.
     *
     * @param string $uuid
     * @param string $name
     * @param string $country
     */
    public function __construct(string $uuid, string $name, string $country)
    {
        $this->uuid = Uuid::fromString($uuid);
        $this->name = Name::fromString($name);
        $this->country = Country::fromString($country);
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
