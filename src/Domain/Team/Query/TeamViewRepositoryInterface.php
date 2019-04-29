<?php
declare(strict_types=1);

namespace App\Domain\Team\Query;

use Ramsey\Uuid\UuidInterface;

interface TeamViewRepositoryInterface
{
    public function oneByUuid(UuidInterface $uuid): TeamViewInterface;

    /**
     * @return TeamViewInterface[]
     */
    public function getAll(): array;
}
