<?php

declare(strict_types=1);

namespace App\Domain\League;

use App\Domain\Shared\Country;
use App\Domain\Shared\Name;
use App\Domain\Team\Team;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

final class League
{
    public const REGISTERED_TEAM_LIMIT = 10;

    /** @var UuidInterface */
    private $uuid;

    /** @var Name */
    private $name;

    /** @var Country */
    private $country;

    /** @var Team[] */
    private $teams;

    /** @var bool */
    private $isInternational;

    /**
     * League constructor.
     *
     * @param UuidInterface $uuid
     * @param Name          $name
     * @param Country       $country
     */
    public function __construct(UuidInterface $uuid, Name $name, Country $country = null)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->country = $country;
        $this->isInternational = null === $country;
        $this->teams = new ArrayCollection();
    }

    public static function international(UuidInterface $uuid, Name $name): self
    {
        return new self($uuid, $name);
    }

    public static function national(UuidInterface $uuid, Name $name, Country $country): self
    {
        return new self($uuid, $name, $country);
    }

    public function registerTeam(Team $team): void
    {
        if (!$this->canAcceptAnotherRegistration()) {
            throw new \DomainException('No more places available.');
        }

        if ($this->teams->contains($team)) {
            throw new \DomainException('Already registered team.');
        }

        if (!$this->isInternational && !$this->country->isEqual($team->country())) {
            throw new \DomainException('Attempting to register a foreign team to a national league.');
        }

        $this->teams->add($team);
    }

    private function canAcceptAnotherRegistration(): bool
    {
        return $this->teams->count() < self::REGISTERED_TEAM_LIMIT;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function teams(): array
    {
        return $this->teams->toArray();
    }

    public function isInternational(): bool
    {
        return $this->isInternational;
    }
}
