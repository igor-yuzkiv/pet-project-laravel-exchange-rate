<?php

namespace App\Repository;

use App\Model\ExchangeRate as Model;
use App\Services\Crawler\CrawlerCurrency;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class ExchangeRateRepository
 * @package App\Repository
 */
class ExchangeRateRepository extends CoreRepository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param string|null $date
     * @return array
     * @throws GuzzleException
     */
    public function parseCurrency(string $date = null)
    {
        $BankRepository = new BankRepository();
        $CrawlerCurrency = new CrawlerCurrency();

        $banks = $BankRepository->getEnabledBanks(["id", "name"]);
        $date = ($date === null)
            ? Carbon::now()->toDateTimeString()
            : Carbon::createFromDate($date)->toDateTimeString();

        $result = array();
        foreach ($banks as $item) {
            $rateData = $CrawlerCurrency->getByBankId($item->id, $date);

            $store_result = $this->startCondition()->massStoreByBank($rateData, $item->id, $date);
            $result[$item->id] = ["name" => $item->name, "result" => $store_result];
        }

        return $result;
    }

    /**
     * @param string $date
     * @param string $currency_code
     * @param int $bank_id
     * @return bool
     */
    public function checkIssetRate(string $date, string $currency_code, int $bank_id): bool
    {
        $date = Carbon::createFromDate($date)->format("Y-m-d");
        $result = $this->startCondition()
            ->where(DB::raw("DATE(`date`)"), $date)
            ->where("currency_code", $currency_code)
            ->where("bank_id", $bank_id)
            ->get();

        return $result->isEmpty();
    }

    /**
     * @return mixed
     */
    public function getAllFiltered()
    {
        $columns = [
            "exchange_rate.currency_code",
            "currencies.currency_name",
            "exchange_rate.sale",
            "exchange_rate.purchase",
            DB::raw("DATE(exchange_rate.date) as date"),
            "exchange_rate.created_at",
            "exchange_rate.updated_at",
            "exchange_rate.bank_id",
            "banks.name",
            "banks.alias",
            "banks.logo_path",
        ];

        $result = $this->startCondition()
            ->select($columns)
            ->join("currencies", "exchange_rate.currency_code", "code")
            ->join("banks", "banks.id", "bank_id");

        $result = $result->filter()->paginate(25);

        return $result;
    }

    /**
     * @param null $bank_id
     * @param bool $baseCurrency
     * @param null $date
     * @return mixed
     */
    public function getRateByBank($bank_id = null, $baseCurrency = true, $date = null)
    {
        $date = ($date === null)
            ? Carbon::now()->format("Y-m-d")
            : Carbon::createFromDate($date)->format("Y-m-d");

        $columns = [
            "exchange_rate.currency_code",
            "currencies.currency_name",
            "exchange_rate.sale",
            "exchange_rate.purchase",
        ];

        $result = $this->startCondition()
            ->select($columns)
            ->join("currencies", "exchange_rate.currency_code", "code")
            ->where(DB::raw("DATE(exchange_rate.date)"), $date);

        if ($baseCurrency) {
            $result = $result->whereIn("exchange_rate.currency_code", config("frontend.base_currency_code"));
        }

        if ($bank_id !== null) {
            $result = $result->where("exchange_rate.bank_id", $bank_id);
        }

        $result = $result->toBase()
            ->get();

        return $result;
    }

    public function getAverage($baseCurrency = true,  $date = null)
    {
        $columns = [
            "exchange_rate.currency_code",
            "currencies.currency_name",
            DB::raw("ROUND(AVG(exchange_rate.sale), 2) as sale"),
            DB::raw("ROUND(AVG(exchange_rate.purchase), 2) as purchase"),
        ];

        $date = ($date === null)
            ? Carbon::now()->format("Y-m-d")
            : Carbon::createFromDate($date)->format("Y-m-d");

        $result = $this->startCondition()
            ->select($columns)
            ->join("currencies", "exchange_rate.currency_code", "currencies.code")
            ->join("banks", "exchange_rate.bank_id", "banks.id")
            ->where("banks.is_enable", 1)
            ->where(DB::raw("DATE(exchange_rate.date)"), $date);

        if ($baseCurrency) {
            $result = $result->whereIn("exchange_rate.currency_code", config("frontend.base_currency_code"));
        }

        $result = $result
            ->groupBy("exchange_rate.currency_code")
            ->toBase()
            ->get();

        return $result;
    }

}
