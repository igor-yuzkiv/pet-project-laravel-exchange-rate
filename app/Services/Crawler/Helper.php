<?php


namespace App\Services\Crawler;


class Helper
{
    /**
     * @param $str
     * @return mixed|null
     */
    public static function getFloat($str) {
        preg_match('/\d+\.\d+/', $str, $matches);
        $result = round($matches[0], 2) ?? null;

        return $result;
    }
}
