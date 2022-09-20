<?php

namespace App\Business\Enum;

enum Format
{
    case XML;
    case JSON;

    public static function tryFromName(string $name): self
    {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }

        throw new \InvalidArgumentException(sprintf('Invalid format: %s', $name));
    }
}
