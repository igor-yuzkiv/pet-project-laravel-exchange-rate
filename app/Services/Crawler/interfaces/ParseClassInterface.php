<?php


namespace App\Services\Crawler\interfaces;


interface ParseClassInterface
{
    public static function parse(string $html) : array;
}
