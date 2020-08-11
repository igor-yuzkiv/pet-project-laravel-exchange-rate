<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ControllerTrait;
use App\Repository\BankRepository;
use App\Repository\CurrencyRepository;
use App\Repository\ExchangeRateRepository;
use Illuminate\Http\Request;

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

    public function index () {
        $dataTable = $this->ExchangeRateRepository->getAllFiltered();


        return view("Frontend.exchange_rate.index", [
            "title" => __("frontend.menu.exchange_rate.index"),
            "dataTable" => $dataTable,
            "filter_data" => [
                "bank_id" => $this->BankRepository->getForSelect(),
                "currency_code" => $this->CurrencyRepository->getForSelect("code", "currency_name"),
            ],
        ]);
    }
}
