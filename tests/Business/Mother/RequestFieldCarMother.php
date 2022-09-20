<?php

namespace App\Tests\Business\Mother;

use App\Business\Model\RequestCar;

class RequestFieldCarMother
{
    public static function create(): RequestCar
    {
        $car = new RequestCar(
            'Audi',
            'A3',
            'Diesel'
        );

        return $car;
    }
}
