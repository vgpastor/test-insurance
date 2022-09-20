<?php

namespace App\Business\Enum;

enum Genre: string
{
    case MAN = 'MAN';
    case WOMAN = 'WOMAN';

    public static function fromName(string $name): ?self
    {
        return match (strtoupper($name)) {
            'HOMBRE' => self::MAN,
            'MUJER' => self::WOMAN,
            default => self::tryFrom($name),
        };
    }

    public static function tryFromName(string $name): ?self
    {
        return self::fromName($name);
    }

    public static function isValid(string $fuel): bool
    {
        return null !== self::tryFromName($fuel);
    }
}
