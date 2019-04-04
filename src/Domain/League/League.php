<?php
declare(strict_types=1);

namespace App\Domain\League;

use Ramsey\Uuid\UuidInterface;

final class League
{
    /** @var UuidInterface */
    private $uuid;

    /** @var Name */
    private $name;

    public function __construct(UuidInterface $uuid, Name $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }

    public function id(): UuidInterface
    {
        return $this->uuid;
    }

    public function name(): Name
    {
        return $this->name;
    }
}