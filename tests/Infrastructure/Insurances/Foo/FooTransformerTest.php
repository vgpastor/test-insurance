<?php

namespace App\Tests\Infrastructure\Insurances\Foo;

use App\Business\Enum\Format;
use App\Business\Model\RequestFields;
use App\Infrastructure\Insurances\Foo\FooTransformer;
use App\Tests\Business\Mother\RequestFieldCarMother;
use App\Tests\Business\Mother\RequestFieldDriverMother;
use PHPUnit\Framework\TestCase;

class FooTransformerTest extends TestCase
{
    private RequestFields $requestFields;

    public function setUp(): void
    {
        $this->requestFields = new RequestFields();
        $this->requestFields->setCar(RequestFieldCarMother::create());
        $this->requestFields->setDriver(RequestFieldDriverMother::create());
    }

    public function testTransform(): void
    {
        $fooTransformer = new FooTransformer();
        $response = $fooTransformer->transform($this->requestFields);

        $this->assertEquals($response->getInsurance(), 'Foo');
        $this->assertEquals($response->getFormat(), Format::XML->name);
    }
}
