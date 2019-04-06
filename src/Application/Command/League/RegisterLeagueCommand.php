<?php

declare(strict_types=1);

namespace App\Application\Command\League;

use App\Domain\League\Name;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class RegisterLeagueCommand
{
    /**
     * @var string
     * @Assert\Uuid()
     * @Assert\NotBlank()
     */
    private $uuid;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $name;

    public function __construct(string $uuid, string $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }

    public function uuid(): UuidInterface
    {
        return Uuid::fromString($this->uuid);
    }

    public function name(): Name
    {
        return Name::fromString($this->name);
    }
}
