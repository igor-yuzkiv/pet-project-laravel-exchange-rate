<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\BankRepository;
use App\Repository\CurrencyRepository;
use App\Repository\ExchangeRateRepository;
use Illuminate\Support\Carbon;

class ExchangeRateController extends Controller
{
    /**
     * @var ExchangeRateRepository
     */
    private $ExchangeRateRepository;

    /**
     * @var CurrencyRepository
     */
    private $CurrencyRepository;

    /**
     * @var BankRepository
     */
    private $BankRepository;

    public function __construct()
    {
        $this->ExchangeRateRepository = app(ExchangeRateRepository::class);
        $this->CurrencyRepository = app(CurrencyRepository::class);
        $this->BankRepository = app(BankRepository::class);
    }


    public function index() {

        $dataTable = $this->ExchangeRateRepository->getAllFiltered();

        return view("Backend.exchange_rate.index", [
            "title" => __("title.exchange_rate.index"),
            "dataTable" => $dataTable,
            "filter_data" => [
                "bank_id" => $this->BankRepository->getForSelect(),
                "currency_code" => $this->CurrencyRepository->getForSelect("code", "currency_name"),
            ],
            "id_data_table" => "exchange_rate_rate_data_table"
        ]);
    }


    /**
     * @param $date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function parseExchangeRateToday()
    {
        $parseResult = $this->ExchangeRateRepository->parseCurrency();
        return view("Backend.exchange_rate.parse_result", [
            "title" => __("title.exchange_rate.parse_exchange_rate"),
            "parseResult" => $parseResult
        ]);
    }
}
