<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use League\ISO3166\Guards;

final class Country
{
    /** @var string */
    private $code;

    private function __construct($alpha3)
    {
        Guards::guardAgainstInvalidAlpha3($alpha3);

        $this->code = $alpha3;
    }

    public static function fromString(string $code): self
    {
        return new self($code);
    }

    public function toString(): string
    {
        return $this->code;
    }

    public function isEqual(self $other): bool
    {
        return $this->code === $other->code;
    }
}
