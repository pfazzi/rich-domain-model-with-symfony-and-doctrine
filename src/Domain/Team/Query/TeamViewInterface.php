<?php
declare(strict_types=1);

namespace App\Domain\Team\Query;

interface TeamViewInterface
{
    public function uuid(): string;

    public function name(): string;
}
