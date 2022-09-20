<?php

namespace App\Business\Enum;

use ValueError;

enum Fuel: string
{
    case GASOLINE = 'gasoline';
    case DIESEL = 'diesel';
    case ELECTRIC = 'electric';

    public static function tryFromName(string $name): self|null
    {
        try {
            return match ($name) {
                'Gasolina' => self::GASOLINE,
                'Diesel' => self::DIESEL,
                'Eléctrico' => self::ELECTRIC,
                default => self::tryFrom($name),
            };
        } catch (ValueError $error) {
            return null;
        }
    }

    public static function isValid(string $fuel): bool
    {
        return null !== self::tryFromName($fuel);
    }
}
