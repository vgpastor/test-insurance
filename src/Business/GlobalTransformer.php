<?php

namespace App\Business;

use App\Business\Model\RequestFields;
use App\Business\Model\ResponseFields;
use App\Infrastructure\Insurances\TransformerInterface;

class GlobalTransformer
{
    /**
     * @var array<string>
     */
    private array $availableInsurances;

    /**
     * @param array<string> $availableInsurances
     */
    public function __construct(
        array $availableInsurances,
    ) {
        $this->availableInsurances = $availableInsurances;
    }

    /**
     * @throws \Exception
     */
    public function transform(RequestFields $requestFields, string $insurance = 'foo'): ResponseFields
    {
        $this->verifyIfInsuranceIsAvailable($insurance);

        // Transform the data
        /** @var TransformerInterface $class */
        $class = '\\App\\Infrastructure\\Insurances\\'.ucfirst($insurance).'\\'.ucfirst($insurance).'Transformer';

        return (new $class())->transform($requestFields);
    }

    /**
     * @throws \Exception
     */
    private function verifyIfInsuranceIsAvailable(string $insurance): void
    {
        if (!in_array($insurance, $this->availableInsurances, true)) {
            throw new \Exception('The insurance '.$insurance.' is not available');
        }
    }
}
