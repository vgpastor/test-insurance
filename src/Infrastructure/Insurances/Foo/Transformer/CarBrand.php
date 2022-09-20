<?php

namespace App\Infrastructure\Insurances\Foo\Transformer;

use ValueError;

enum CarBrand: int
{
    case BMW = 10;
    case AUDI = 11;
    case MERCEDES = 12;
    case SEAT = 13;
    case VOLKSWAGEN = 14;
    case FORD = 15;

    public static function fromString(string $brand): string
    {
        foreach (self::cases() as $case) {
            if ($case->name === strtoupper($brand)) {
                return (string) $case->value;
            }
        }
        throw new ValueError("$brand is not a valid backing value for enum ".self::class);
    }
}
