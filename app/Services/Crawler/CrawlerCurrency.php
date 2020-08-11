<?php


namespace App\Services\Crawler;

use App\Model\BanksOptions;
use App\Services\Crawler\interfaces\ParseClassInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Carbon;

/**
 * Class CrawlerCurrency
 * @package App\Services\Crawler
 */
class CrawlerCurrency
{

    /**
     * @var
     */
    private $bank_options;

    /**
     * @var null
     */
    private $date = null;

    /**
     * @param $bank_id
     * @param null $date
     * @return array|null
     * @throws GuzzleException
     */
    public function getByBankId($bank_id, $date = null)
    {
        $this->bank_options = BanksOptions::whereBank_id($bank_id)->first();
        $this->date = $date;

        $url = $this->prepareUrl();
        try {
            $Client = new Client();
            $request = $Client->request($this->bank_options->request_method, $url);

            $result = null;

            if (class_exists($this->bank_options->parse_class) AND (new $this->bank_options->parse_class) instanceof ParseClassInterface) {

                $result = $this->bank_options->parse_class::parse($request->getBody()->getContents());

            } else {
                switch ($this->bank_options->request_content_type) {
                    case "json":
                        $result = $this->prepareJSONArray($request->getBody()->getContents());
                        break;

                        //TODO: maybe XML, HTML, ...

                }
            }

            return $result;

        } catch (Exception $e) {
            //TODO: Write to Log
            return null;
        }

    }

    /*
     *
     */
    private function prepareJSONArray($raw)
    {
        $raw = json_decode($raw, true);

        $raw = ($this->bank_options->result_selector == null) ? $raw : $raw[$this->bank_options->result_selector];

        $result = array();
        foreach ($raw as $item) {
            if ($this->checkIssetItem($item)) {
                $result[] = [
                    "currency_code" => $item[$this->bank_options->replace_key_currency_code],
                    "sale" => round($item[$this->bank_options->replace_key_sale], 2),
                    "purchase" => round($item[$this->bank_options->replace_key_purchase], 2),
                ];
            } else
                continue;

        }

        return $result;
    }


    /**
     * @return string
     */
    private function prepareUrl()
    {
        $url = $this->bank_options->base_url;

        $query_attributes = $this->bank_options->getAttribute("query_attributes");
        if (is_array($query_attributes) AND !empty($query_attributes)) {
            $url .= "?";

            foreach ($query_attributes as $key => $query_attribute) {
                $url .= $key . "=" . $query_attribute;

                if ($key != array_key_last($query_attributes))
                    $url .= "&";
            }

            $url .= "&" . $this->prepareDate();
        } else {
            $url .= "?" . $this->prepareDate();
        }

        return $url;
    }

    /**
     * @return string
     */
    private function prepareDate()
    {
        if ($this->date == null) {
            $result = Carbon::now()->format($this->bank_options->date_format);
        } else {
            $result = Carbon::createFromDate($this->date)->format($this->bank_options->date_format);
        }

        return ($result == null) ? "" : $this->bank_options->date_query_param . "=" . $result;
    }

    /**
     * @param array $item
     * @return bool
     */
    private function checkIssetItem(array $item): bool
    {
        if (
            isset($item[$this->bank_options->replace_key_sale])
            and isset($item[$this->bank_options->replace_key_purchase])
            and isset($item[$this->bank_options->replace_key_currency_code])
        ) {
            return true;
        } else
            return false;
    }
}
