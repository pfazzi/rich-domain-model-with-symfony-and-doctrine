<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use Assert\Assertion;

final class Name
{
    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        Assertion::maxLength($value, 30, 'A Name is suppose to be at most 30 letters.');

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

    public function isEqual(self $other): bool
    {
        return $this->value === $other->value;
    }
}
