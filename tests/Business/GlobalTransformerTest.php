<?php

namespace App\Tests\Business;

use App\Business\GlobalTransformer;
use App\Tests\Business\Mother\RequestFieldsMother;
use PHPUnit\Framework\TestCase;

class GlobalTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $globalTransformer = new GlobalTransformer(['Foo', 'Bar']);
        $response = $globalTransformer->transform(RequestFieldsMother::create(), 'Foo');
        $this->assertEquals($response->getInsurance(), 'Foo');
        $this->assertInstanceOf('App\Business\Model\ResponseFields', $response);
    }

    public function testWrongInsurance(): void
    {
        $globalTransformer = new GlobalTransformer(['Foo', 'Bar']);
        try {
            $globalTransformer->transform(RequestFieldsMother::create(), 'Wrong insurance');
            $this->fail('Exception expected');
        } catch (\Exception $e) {
            $this->assertStringContainsString('is not available', $e->getMessage());
        }
    }
}
