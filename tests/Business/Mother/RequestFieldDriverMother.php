<?php

namespace App\Tests\Business\Mother;

use App\Business\Model\RequestDriver;

class RequestFieldDriverMother
{
    public static function create(): RequestDriver
    {
        $driver = new RequestDriver(
            '1980-01-01',
            'USA',
            'USA',
            'No',
            'Mujer'
        );

        return $driver;
    }
}
