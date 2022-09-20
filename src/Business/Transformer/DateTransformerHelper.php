<?php

namespace App\Business\Transformer;

class DateTransformerHelper
{
    public static function transformDateFromString(string $dateString): \DateTime
    {
        $formats = ['d/m/Y', 'd-m-Y', 'Y-m-d', 'Y/m/d'];
        foreach ($formats as $format) {
            $date = \DateTime::createFromFormat($format, $dateString);
            if ($date) {
                return $date;
            }
        }

        throw new \RuntimeException('The date '.$dateString.' is not valid');
    }
}
