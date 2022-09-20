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
        try {
            return self::tryFrom($name);
        } catch (ValueError $error) {
            return null;
        }
    }

}
