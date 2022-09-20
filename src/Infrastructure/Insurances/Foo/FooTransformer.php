<?php

namespace App\Infrastructure\Insurances\Foo;

use App\Business\Model\RequestFields;
use App\Business\Model\ResponseFields;
use App\Infrastructure\Insurances\Foo\Transformer\CarBrand;
use App\Infrastructure\Insurances\Foo\Transformer\CarFuel;
use App\Infrastructure\Insurances\TransformerInterface;

class FooTransformer implements TransformerInterface
{
    private \SimpleXMLElement $output;

    public function transform(RequestFields $requestFields): ResponseFields
    {
        $this->output = new \SimpleXMLElement('<TarificacionThirdPartyRequest/>');
        // Static values?
        $this->output->addChild('Cotizacion', '0');
        $this->output->addChild('Empresa', '4');
        $this->output->addChild('Identificador', 'ag36187w@SW11PX44');

        $data = $this->output->addChild('Datos');

        $data = $this->fillVehicle($requestFields, $data);

        return new ResponseFields(
            'Foo',
            'XML',
            (string) $this->output->asXML()
        );
    }

    /**
     * @throws \Exception
     */
    private function fillVehicle(RequestFields $requestFields, \SimpleXMLElement $data): \SimpleXMLElement
    {
        $vehicle = $data->addChild('DatosVehiculo');
        $vehicle->addChild('CodMarca', str_pad(CarBrand::fromString($requestFields->getCar()->getBrand()), 4, '0', STR_PAD_LEFT));
        $vehicle->addChild('CodModelo', 'CLIO');
        $vehicle->addChild('CodTiempoCompra', '1');
        $vehicle->addChild('Combustible', CarFuel::fromString($requestFields->getCar()->getFuel()->value));
        $vehicle->addChild('CodUso', '10');
        if (null !== $requestFields->getCar()->getPurchaseDate()) {
            $vehicle->addChild('FecMatriculacion', $requestFields->getCar()->getPurchaseDate()->format('Y-m-dTH:i:s'));
        }
        $vehicle->addChild('KmVehiculo', '5000');

        return $data;
    }
}
