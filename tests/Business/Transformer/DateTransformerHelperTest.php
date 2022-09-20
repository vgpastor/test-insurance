<?php

namespace App\Tests\Business\Transformer;

use App\Business\Transformer\DateTransformerHelper;
use PHPUnit\Framework\TestCase;

class DateTransformerHelperTest extends TestCase
{
    public function testTransformDateFromString(): void
    {
        $dates = ['2021-01-01', '2021/01/01', '01/01/2021', '01-01-2021'];
        foreach ($dates as $date) {
            $transformedDate = DateTransformerHelper::transformDateFromString($date);
            $this->assertStringContainsString('2021-01-01', $transformedDate->format('Y-m-d'));
        }
        try {
            DateTransformerHelper::transformDateFromString('01/01-2021');
            $this->fail('Exception not thrown');
        } catch (\Exception $e) {
            $this->assertStringContainsString('is not valid', $e->getMessage());
        }
    }
}
