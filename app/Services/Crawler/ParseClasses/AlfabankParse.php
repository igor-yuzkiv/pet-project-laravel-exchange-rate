<?php


namespace App\Services\Crawler\ParseClasses;


use App\Services\Crawler\CrawlerCurrency;
use App\Services\Crawler\Helper;
use App\Services\Crawler\interfaces\ParseClassInterface;
use Symfony\Component\DomCrawler\Crawler;

class AlfabankParse implements ParseClassInterface
{
    public static function parse(string $html): array
    {
        $crawler = new Crawler();
        $crawler->addHtmlContent($html);
        $result = array();

        $crawler->filter('div.department div.currency-item-number')->each(function (Crawler $node) use (&$result) {
            $data_currency = $node->filter(" span.rate-number");
            $attribute = $data_currency->attr("data-currency");
            $currency = explode('_', $attribute)[0] ?? null;

            $result[$currency]["currency_code"] = $currency;

            if (preg_match('/(_BUY)/', $attribute)) {
                $result[$currency]["purchase"] = Helper::getFloat($data_currency->text());
            }elseif (preg_match('/(_SALE)/', $attribute)){
                $result[$currency]["sale"] = Helper::getFloat($data_currency->text());
            }

        });

        return $result;

    }
}
