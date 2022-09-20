<?php

namespace App\Business\Model;

use App\Business\Enum\Format;

class ResponseFields
{
    private string $insurance;

    private Format $format;

    private string $data;

    public function __construct(string $insurance, string $format, string $data)
    {
        $this->insurance = $insurance;
        $this->format = Format::tryFromName($format);
        $this->data = $data;
    }

    public function getInsurance(): string
    {
        return $this->insurance;
    }

    public function getFormat(): string
    {
        return $this->format->name;
    }

    public function getData(): string
    {
        return $this->data;
    }
}
