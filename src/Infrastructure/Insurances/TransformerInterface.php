<?php

namespace App\Infrastructure\Insurances;

use App\Business\Model\RequestFields;
use App\Business\Model\ResponseFields;

interface TransformerInterface
{
    public function transform(RequestFields $requestFields): ResponseFields;
}
