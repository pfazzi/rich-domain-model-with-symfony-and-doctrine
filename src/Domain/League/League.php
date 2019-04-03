<?php
declare(strict_types=1);

namespace App\Domain\League;

use Ramsey\Uuid\UuidInterface;

final class League
{
    /** @var UuidInterface */
    private $id;

    /** @var Name */
    private $name;

    public function __construct(UuidInterface $id, Name $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }
}