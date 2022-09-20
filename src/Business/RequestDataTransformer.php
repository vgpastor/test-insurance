<?php

namespace App\Business;

use App\Business\Enum\Genre;
use App\Business\Enum\Location;
use App\Business\Model\RequestCar;
use App\Business\Model\RequestDriver;
use App\Business\Model\RequestFields;

class RequestDataTransformer
{
    /**
     * @var array<string,string>
     */
    private array $originalData;

    private RequestFields $requestFields;

    /**
     * @param array<string,string> $originalData
     *
     * @throws InputDataException
     */
    public function transform(array $originalData): RequestFields
    {
        $this->originalData = $originalData;
        $this->requestFields = new RequestFields();

        $this->validateVehicle();

        $this->validateDriver();

        return $this->requestFields;
    }

    /**
     * @throws InputDataException
     */
    private function validateVehicle(): void
    {
        $requiredFields = ['car_brand', 'car_model', 'car_fuel'];
        $this->verifyRequiredFields($requiredFields);

        $requestCar = new RequestCar(
            $this->originalData['car_brand'],
            $this->originalData['car_model'],
            $this->originalData['car_fuel']
        );

        $requestCar->setPurchaseDate($this->originalData['car_purchaseDate']);

        $this->requestFields->setCar($requestCar);
    }

    /**
     * @throws InputDataException
     */
    private function validateDriver(): void
    {
        $requiredFields = ['driver_birthDate', 'driver_birthPlace', 'driver_birthPlaceMain', 'driver_children', 'driver_sex'];
        $this->verifyRequiredFields($requiredFields);

        if (!Location::isValid($this->originalData['driver_birthPlace'])) {
            throw new InputDataException('driver_birthPlace', 'Birth place is not valid');
        }
        if (!Location::isValid($this->originalData['driver_birthPlaceMain'])) {
            throw new InputDataException('driver_birthPlaceMain', 'Birth place Main is not valid');
        }
        if (!Genre::isValid($this->originalData['driver_sex'])) {
            throw new InputDataException('driver_sex', 'Driver Sex is not valid');
        }

        $driver = new RequestDriver(
            $this->originalData['driver_birthDate'],
            $this->originalData['driver_birthPlace'],
            $this->originalData['driver_birthPlaceMain'],
            $this->originalData['driver_children'],
            $this->originalData['driver_sex'],
        );

        $this->requestFields->setDriver($driver);
    }

    /**
     * @param array<string> $requiredFields
     *
     * @throws InputDataException
     */
    private function verifyRequiredFields(array $requiredFields): void
    {
        // Verify that requiredFileds are present and contains data
        foreach ($requiredFields as $requiredField) {
            if (!isset($this->originalData[$requiredField]) || empty($this->originalData[$requiredField])) {
                throw new InputDataException($requiredField, 'The field '.$requiredField.' is required');
            }
        }
    }
}
