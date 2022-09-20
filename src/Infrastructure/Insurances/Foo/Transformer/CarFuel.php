<?php

namespace App\Infrastructure\Insurances\Foo\Transformer;

use ValueError;

enum CarFuel: string
{
    case DIESEL = 'diesel';
    case ELECTRIC = 'electrico';
    case GASOLINE = 'gasolina';

    public static function fromString(string $fuel): string
    {
        foreach (self::cases() as $case) {
            if ($case->name === mb_strtoupper($fuel)) {
                return $case->value;
            }
        }
        throw new ValueError("$fuel is not a valid backing value for enum ".self::class);
    }
}
