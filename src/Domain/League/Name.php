<?php

declare(strict_types=1);

namespace App\Domain\League;

use Assert\Assertion;

final class Name
{
    private $value;

    private function __construct($value)
    {
        Assertion::maxLength(30, $value, 'A Name is suppose to be at most 30 letters.');

        $this->value = $value;
    }

    public static function fromString(string $name): self
    {
        return new self($name);
    }

    public function toString(): string
    {
        return $this->value;
    }
}
