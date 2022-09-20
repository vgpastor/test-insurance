<?php

namespace App\Business\Enum;

enum Location: string
{
    case USA = 'USA';
    case UK = 'UK';
    case FRANCE = 'FRANCE';
    case GERMANY = 'GERMANY';
    case SPAIN = 'ESP';

    public static function tryFromName(string $name): self|null
    {
        return self::tryFrom($name);
    }

    public static function isValid(string $fuel): bool
    {
        return null !== self::tryFromName($fuel);
    }
}
