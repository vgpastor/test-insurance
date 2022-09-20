<?php

namespace App\Tests\Business\Mother;

use App\Business\Model\RequestFields;

class RequestFieldsMother
{
    public static function create(): RequestFields
    {
        $requestFields = new RequestFields();
        $requestFields->setCar(RequestFieldCarMother::create());
        $requestFields->setDriver(RequestFieldDriverMother::create());

        return $requestFields;
    }
}
