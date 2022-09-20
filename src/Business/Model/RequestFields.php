<?php

namespace App\Business\Model;

class RequestFields
{
    private RequestCar $car;

    private RequestDriver $driver;

    public function setCar(RequestCar $requestCar): self
    {
        $this->car = $requestCar;

        return $this;
    }

    public function getCar(): RequestCar
    {
        return $this->car;
    }

    public function getDriver(): RequestDriver
    {
        return $this->driver;
    }

    public function setDriver(RequestDriver $driver): RequestFields
    {
        $this->driver = $driver;

        return $this;
    }
}
