<?php


namespace App\Services\Crawler\ParseClasses;


use App\Services\Crawler\interfaces\ParseClassInterface;

class OschadbankParse implements ParseClassInterface
{
    public static function parse(string $html): array
    {
        return [];
    }

}
