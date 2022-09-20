<?php

namespace App\Business\Enum;

use ValueError;

enum Genre: string
{
    case MAN = 'MAN';
    case WOMAN = 'WOMAN';

    public static function fromName(string $name): ?self
    {
        try {
            return match (strtoupper($name)) {
                'HOMBRE' => self::MAN,
                'MUJER' => self::WOMAN,
                default => self::tryFrom($name),
            };
        } catch (ValueError $error) {
            return null;
        }
    }

    public static function tryFromName(string $name): ?self
    {
        try {
            return self::fromName($name);
        } catch (ValueError $error) {
            return null;
        }
    }
}
