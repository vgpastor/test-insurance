<?php

namespace App\Tests\Business;

use App\Business\Enum\Fuel;
use App\Business\Enum\Genre;
use App\Business\Enum\Location;
use App\Business\InputDataException;
use App\Business\RequestDataTransformer;
use PHPUnit\Framework\TestCase;

class RequestDataTransformerTest extends TestCase
{
    /**
     * @var array<string, string> $originalData
     */
    private array $originalData;

    /**
     * @throws \JsonException
     */
    public function setUp(): void
    {
        $fileData = file_get_contents(__DIR__.'/../demoData1.json');
        if (false === $fileData) {
            throw new \RuntimeException('File not found');
        }
        $this->originalData = json_decode($fileData, true, 512, JSON_THROW_ON_ERROR);
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * @throws InputDataException
     * @throws \JsonException
     */
    public function testTransform(): void
    {
        $transformedData = (new RequestDataTransformer())->transform($this->originalData);

        $this->assertStringContainsString('SEAT', $transformedData->getCar()->getBrand());
        $this->assertNull($transformedData->getCar()->getPurchaseDate());
        $this->assertEquals(Fuel::GASOLINE, $transformedData->getCar()->getFuel());

        $this->assertEquals(Genre::WOMAN, $transformedData->getDriver()->getGenre());
        $this->assertEquals(Location::SPAIN, $transformedData->getDriver()->getBrithPlace());
        $this->assertStringContainsString('2002-06-05', $transformedData->getDriver()->getBirthDate()->format('Y-m-d'));
    }

    public function testDateTrasnform(): void
    {
        $this->originalData['car_purchaseDate'] = '2021/01/01';
        $transformedData = (new RequestDataTransformer())->transform($this->originalData);
        $this->assertStringContainsString('2021-01-01', $transformedData->getCar()->getPurchaseDate()->format('Y-m-d'));

        $this->originalData['car_purchaseDate'] = '01/01-2021';
        try {
            (new RequestDataTransformer())->transform($this->originalData);
            $this->fail('Exception not thrown');
        } catch (InputDataException $e) {
            $this->assertEquals('car_purchaseDate', $e->getField());
            $this->assertStringContainsString('Invalid date', $e->getMessage());
        }
    }

    public function testCarFuel(): void
    {
        $this->originalData['car_fuel'] = 'pedales';
        try {
            (new RequestDataTransformer())->transform($this->originalData);
            $this->fail('Exception not thrown');
        } catch (InputDataException $e) {
            $this->assertEquals('car_fuel', $e->getField());
            $this->assertStringContainsString('is not valid', $e->getMessage());
        }
    }

    public function testLocation(): void
    {
        $this->originalData['driver_birthPlace'] = 'Marte';
        try {
            (new RequestDataTransformer())->transform($this->originalData);
            $this->fail('Exception not thrown');
        } catch (InputDataException $e) {
            $this->assertEquals('driver_birthPlace', $e->getField());
            $this->assertStringContainsString('is not valid', $e->getMessage());
        }
    }

    public function testCarMissingField(): void
    {
        unset($this->originalData['car_brand']);
        try {
            (new RequestDataTransformer())->transform($this->originalData);
            $this->fail('Exception not thrown');
        } catch (InputDataException $e) {
            $this->assertEquals('car_brand', $e->getField());
            $this->assertStringContainsString('is required', $e->getMessage());
        }
    }

    public function testDriverMissingField(): void
    {
        unset($this->originalData['driver_birthDate']);
        try {
            (new RequestDataTransformer())->transform($this->originalData);
            $this->fail('Exception not thrown');
        } catch (InputDataException $e) {
            $this->assertEquals('driver_birthDate', $e->getField());
            $this->assertStringContainsString('is required', $e->getMessage());
        }
    }
}
