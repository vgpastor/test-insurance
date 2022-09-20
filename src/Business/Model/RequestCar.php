<?php

namespace App\Business\Model;

use App\Business\Enum\Fuel;
use App\Business\InputDataException;
use App\Business\Transformer\DateTransformerHelper;

class RequestCar
{
    private string $brand;
    private string $model;
    private Fuel $fuel;
    private ?\DateTime $purchaseDate = null;

    public function __construct(string $brand, string $model, string $fuel)
    {
        $this->brand = $brand;
        $this->model = $model;

        if (!Fuel::isValid($fuel)) {
            throw new InputDataException('car_fuel', 'The fuel '.$fuel.' is not valid');
        }
        $this->fuel = Fuel::tryFromName($fuel);
    }

    public function setPurchaseDate(string $purchaseDate): self
    {
        if (strlen($purchaseDate) <= 0) {
            return $this;
        }
        try {
            $this->purchaseDate = DateTransformerHelper::transformDateFromString($purchaseDate);
        } catch (\Exception $e) {
            throw new InputDataException('car_purchaseDate', 'Invalid date format in PurchaseDate');
        }

        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getFuel(): Fuel
    {
        return $this->fuel;
    }

    public function getPurchaseDate(): ?\DateTime
    {
        return $this->purchaseDate;
    }
}
